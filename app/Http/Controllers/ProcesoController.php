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
use App\User;
use App\Http\Requests\ProcesoFormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Mail\ProcessNotification;
use Illuminate\Support\Facades\Mail;

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

        $procesos = Proceso::select(
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
            return view('proceso.index', $Procesos)->with('success','Busqueda realizada');
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
        return redirect()->route('proceso.index')->with('success','Proceso almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function show(Proceso $proceso)
    {
        $auditoria = User::findOrFail($proceso)->first();

        
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
        ->where('proceso.id', '=', $proceso->id)->first();
        return view('proceso.show', compact('proceso', 'auditoria'));
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
        return redirect()->route('proceso.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceso $proceso)
    {
        $valida1 = Actuacionproceso::where('proceso_id', '=', $proceso->id)->get();
        $valida2 = Recordatorioproceso::where('proceso_id', '=', $proceso->id)->get();
        $valida3 = Clienteproceso::where('proceso_id', '=', $proceso->id)->get();
        if ($valida1->isEmpty() && $valida2->isEmpty() && $valida3->isEmpty()) {
            $proceso->delete();
            return redirect()->route('proceso.index')->with('success','Registro borrado completamente');
        }else {
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

            return redirect()->route('proceso.index')->withErrors($errors);
        }
    }

    public function sendEmail($id){
        $correos = Proceso::select('proceso.id', 
            'proceso.codigo AS proceso_codigo', 
            'proceso.numero AS proceso_numero', 
            'personanatural.codigo AS personanatural_codigo', 
            'correo.electronico AS email')
        ->join('clienteproceso', 'proceso.id', '=', 'clienteproceso.proceso_id')
        ->join('personanatural', 'clienteproceso.proceso_id', '=', 'personanatural.id')
        ->join('correo', 'personanatural.id', '=', 'correo.personanatural_id')
        ->where('correo.principal', '=', 1)->get();
        
        if ($correos->isEmpty()){
            return redirect()->route('proceso.index')->withErrors(['No se encontraton correos relacionados al proceso']);
        }

        $contador = 0;
        foreach ($correos as $correo){
            Mail::to($receivers)->send(new ProcessNotification($call));
            $contador += 1;
        }

        return redirect()->route('proceso.index')->with('success','Correos enviados');
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
