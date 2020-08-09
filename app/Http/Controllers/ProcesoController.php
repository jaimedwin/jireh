<?php

namespace App\Http\Controllers;

use DB; 
use App\Models\Proceso;
use App\Models\Ciudadproceso;
use App\Models\Corporacion;
use App\Models\Ponente;
use App\Models\Estado;
use App\Models\Actuacionproceso;
use App\Models\Recordatorioproceso;
use App\Models\Clienteproceso;
use App\Models\Contrato;
use App\Models\Documentoproceso;
use App\Models\Consultacorreo;
use App\User;
use App\Http\Requests\ProcesoFormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Mail\ProcessNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ProcesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $palabrasbuscar = explode(" ",$request->post('buscar')); 

        $procesos = Proceso::orderBy('proceso.id', 'DESC')
        ->select(
            'proceso.id','proceso.numero', 'proceso.codigo',
            'ciudadproceso.nombre AS ciudadproceso', 
            'corporacion.nombre AS corporacion', 
            'ponente.nombrecompleto AS ponente', 
            'estado.descripcion AS estado')
        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
        ->join('estado', 'proceso.estado_id', '=', 'estado.id');

        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['codigo', 'numero', 'ciudadproceso.nombre', 
            'corporacion.nombre', 'ponente.nombrecompleto', 'estado.descripcion'];
            $Procesos['Procesos'] = $procesos->whereOrSearch($palabrasbuscar, $columnas);
            return view('proceso.index', $Procesos)->with('success',['Busqueda realizada']);
        }else{
            $Procesos['Procesos'] = $procesos->paginate(10);
            
            return view('proceso.index', $Procesos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudadprocesos = Ciudadproceso::all();
        $corporacions = Corporacion::all();
        $ponentes = Ponente::all();
        $estados = Estado::all();
        return view('proceso.create', compact ('ciudadprocesos', 'corporacions', 'ponentes', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcesoFormRequest $request)
    {
        $d = $request->except('_token');
        Proceso::create($d);
        return redirect()->route('proceso.index')->with('success',['Proceso almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proceso = Proceso::select(
                            'proceso.*',
                            'ciudadproceso.nombre AS ciudadproceso', 
                            'corporacion.nombre AS corporacion', 
                            'ponente.nombrecompleto AS ponente', 
                            'estado.descripcion AS estado')
                        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
                        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
                        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
                        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
                        ->findOrFail($id);

        $Clientesproceso = Clienteproceso::select('clienteproceso.id', 'clienteproceso.personanatural_id',
                        'clienteproceso.proceso_id', 'personanatural.id', 'personanatural.nombres',
                        'personanatural.nombres', 'personanatural.apellidopaterno',
                        'personanatural.apellidomaterno', 'tipodemanda.abreviatura AS tipodemanda')
                        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('tipodemanda', 'tipodemanda_id', '=', 'tipodemanda.id')
                        ->join('personanatural', 'clienteproceso.personanatural_id', '=','personanatural.id')
                        ->where('clienteproceso.proceso_id', '=', $id)
                        ->orderBy('clienteproceso.created_at', 'DESC')
                        ->get();

        $Documentosproceso = Documentoproceso::select('documentoproceso.*',
                        'tipodocumento.abreviatura AS tipodocumento',
                        'tipodocumento.descripcion AS tipodocumento_descripcion')
                        ->join('tipodocumento', 'tipodocumento_id', '=', 'tipodocumento.id')
                        ->where('documentoproceso.proceso_id', '=', $id)
                        ->get();
        
        $Recordatoriosproceso = Recordatorioproceso::where('proceso_id', '=', $id)->get();

        $Actuacionesproceso = Actuacionproceso::orderBy( 'fechaactuacion', 'DESC')->where('proceso_id', '=', $id)->get();

        $auditoria = User::findOrFail($proceso->users_id);

        return view('proceso.show', compact('proceso', 'auditoria', 'Documentosproceso', 'Recordatoriosproceso', 
                        'Actuacionesproceso', 'Clientesproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceso $proceso)
    {
        $ciudadprocesos = Ciudadproceso::all();
        $corporacions = Corporacion::all();
        $ponentes = Ponente::all();
        $estados = Estado::all();
        return view('proceso.edit', compact('proceso','ciudadprocesos', 'corporacions', 'ponentes', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function update(ProcesoFormRequest $request, Proceso $proceso)
    {
        $proceso->update($request->all());
        return redirect()->route('proceso.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida1 = Actuacionproceso::where('proceso_id', '=', $id)->get();
        $valida2 = Recordatorioproceso::where('proceso_id', '=', $id)->get();
        $valida3 = Clienteproceso::where('proceso_id', '=', $id)->get();
        $valida4 = Contrato::where('proceso_id', '=', $id)->get();
        if ($valida1->isEmpty() && $valida2->isEmpty() && $valida3->isEmpty() && $valida4->isEmpty()) {
            $proceso = Proceso::findOrFail($id);
            if( $proceso->delete())
                return redirect()->route('proceso.index')->with('success',['Registro borrado completamente']);
        }
        
        $errors = array('No se puede borrar el proceso');
        if (!$valida1->isEmpty()){
            array_push($errors, 'El proceso tiene actuacione(s) asociada(s)');
        }
        if (!$valida2->isEmpty()){
            array_push($errors,'El proceso tiene recordatorio(s) asociado(s)');
        }
        if (!$valida3->isEmpty()){
            array_push($errors,'El proceso está asociado con persona(s) naturales(s)');
        }
        if (!$valida4->isEmpty()){
            array_push($errors,'El proceso está asociado con contrato(s)');
        }
        return redirect()->route('proceso.index')->withErrors($errors);
        
    }

    public function listEmail($id, Request $request){

        $palabrasbuscar = explode(" ",$request->post('buscar'));  

        $consultas = Proceso::select('proceso.id', 
            'personanatural.numerodocumento AS personanatural_numerodocumento', 
            'correo.electronico AS email')
        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
        ->join('clienteproceso', 'proceso.id', '=', 'clienteproceso.proceso_id')
        ->join('personanatural', 'clienteproceso.personanatural_id', '=', 'personanatural.id')
        ->join('correo', 'personanatural.id', '=', 'correo.personanatural_id')
        ->where('proceso.id', '=', $id);
        
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['personanatural.numerodocumento', 'correo.electronico', 
            'personanatural.nombres', 'personanatural.apellidopaterno', 
            'personanatural.apellidomaterno'];
            $consultas = $consultas->whereOrSearch($palabrasbuscar, $columnas);
            return view('proceso.correo.index', compact('id', 'consultas'))->with('success',['Busqueda realizada']);
        }else{
            $consultas = $consultas->paginate(10);
        }

        return view('proceso.correo.index', compact('id', 'consultas'));
    }

    public function sendEmail($id){
        $consultas = Proceso::select('proceso.id', 
                'proceso.codigo AS proceso_codigo', 
                'proceso.numero AS proceso_numero', 
                'personanatural.codigo AS personanatural_codigo', 
                'personanatural.fechaexpedicion AS personanatural_fechaexpedicion',
                'correo.electronico AS email')
            ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
            ->join('clienteproceso', 'proceso.id', '=', 'clienteproceso.proceso_id')
            ->join('personanatural', 'clienteproceso.personanatural_id', '=', 'personanatural.id')
            ->join('correo', 'personanatural.id', '=', 'correo.personanatural_id')
            ->where('proceso.id', '=', $id)
            ->get();
        
        if ($consultas->isEmpty()){
            return redirect()->route('proceso.index')->withErrors(['No se encontraron correos relacionados al proceso']);
        }

        $contador = 0;
        foreach ($consultas as $consulta){
            $subject = 'Cambio en las actuaciones registradas';
            $url = url(route('consultacliente'));
            $proceso_numero = $consulta->proceso_numero;
            $proceso_codigo = $consulta->proceso_codigo;
            $personanatural_codigo = $consulta->personanatural_codigo;
            $nombrecompleto = $consulta->nombrecompleto;
            $personanatural_fechaexpedicion = $consulta->personanatural_fechaexpedicion;
            Mail::to($consulta->email)->send(
                new ProcessNotification($proceso_numero, $url, $proceso_codigo, 
                                        $nombrecompleto, $personanatural_codigo, 
                                        $personanatural_fechaexpedicion, $subject)
                );
            
            // Registra que se envìo un correo de notificación con el cambio en las actuaciones.
            $mensaje =  'Código del proceso: ' . $proceso_codigo . '<br>' .
                        'Número del proceso: ' . $proceso_numero . '<br>' .
                        'Código del cliente: ' . $personanatural_codigo . '<br>' .
                        'Contraseña: ' . $personanatural_fechaexpedicion . '<br>' .
                        'Nómbre del cliente: ' . $nombrecompleto . '<br>';

            $consultacorreo = new Consultacorreo;
            $consultacorreo->a = $consulta->email;
            $consultacorreo->mensaje = $mensaje;
            $consultacorreo->consultacorreotipo_id = 2;
            $consultacorreo->created_at = Carbon::now();
            $consultacorreo->save();

            $contador += 1;
        }

        return redirect()->route('proceso.index')->with('success',[ $contador .' correo(s) enviado(s)']);
    }


    public function getCsv(){
        $procesos = Proceso::select(
            'proceso.*',
            'ciudadproceso.nombre AS ciudadproceso', 
            'corporacion.nombre AS corporacion', 
            'ponente.nombrecompleto AS ponente', 
            'estado.descripcion AS estado')
        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
        ->join('estado', 'proceso.estado_id', '=', 'estado.id')->get();  
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($procesos, [
            'id',
            'codigo',
            'numero',
            'ciudadproceso_id',
            'ciudadproceso',
            'corporacion_id',
            'corporacion',
            'ponente_id',
            'ponente',
            'estado_id',
            'estado',
            'users_id',
            'created_at',
            'updated_at',
        ])->download();
    }
}
