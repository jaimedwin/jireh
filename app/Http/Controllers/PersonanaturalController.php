<?php

namespace App\Http\Controllers;
//namespace App\Http\Class;

use App\Models\Personanatural;
use App\Models\Tipodocumentoidentificacion;
use App\Models\Fondodepension;
Use App\Models\Municipio;
use App\Models\Eps;
use App\Models\Grado;
use App\Models\Correo;
use App\Models\Telefono;
use App\Models\Documento;
use App\Models\Clienteproceso;
use App\Models\Contrato;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonanaturalFormRequest;
use Illuminate\Support\Facades\DB;

class PersonanaturalController extends Controller 
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
        $Personasnaturales = Personanatural::orderBy('personanatural.id', 'ASC')
                                ->select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'municipio.nombre AS expedicion_municipio',
                                'departamento.nombre AS expedicion_departamento',
                                'departamento.nombre AS departamento_nombre',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('municipio','municipio_id','=','municipio.id')
                                ->join('departamento','departamento_id','=','departamento.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id');  
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['codigo', 'nombres', 'apellidopaterno', 'apellidomaterno', 
                'numerodocumento', 'direccion', 'fondodepension.abreviatura', 
                'eps.abreviatura', 'fuerza.abreviatura', 'grado.abreviatura', 
                'municipio.nombre', 'departamento.nombre'];
            $personasnaturales['Personasnaturales'] = $Personasnaturales
            ->whereOrSearch($palabrasbuscar, $columnas);
            return view('personanatural.index',  $personasnaturales)->with('success',['Busqueda realizada']);
        }else{
            $personasnaturales['Personasnaturales'] = $Personasnaturales->paginate(10);
            return view('personanatural.index', $personasnaturales);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Tiposdocumentosidentificacion = Tipodocumentoidentificacion::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Fondodepensiones = Fondodepension::
            select('id', 'abreviatura', 'descripcion')->orderBy('id', 'ASC')->get();
        $Expediciones = Municipio::
            select('municipio.id', 'municipio.nombre AS municipio', 'departamento.nombre AS departamento')->orderBy('municipio.nombre', 'ASC')
            ->join('departamento','departamento_id','=','departamento.id')
            ->get();
        $Eps = Eps::select('id', 'abreviatura')->orderBy('id', 'ASC')->get();
        $Grados = Grado::select('grado.id', 'grado.abreviatura', 'grado.descripcion', 'fuerza.abreviatura AS fuerza')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->orderBy('fuerza.abreviatura', 'ASC')
                        ->get();
        return view('personanatural.create', compact('Tiposdocumentosidentificacion', 'Fondodepensiones', 'Expediciones', 'Eps', 'Grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonanaturalFormRequest $request)
    {
        $d = $request->except('_token');
        $personanatural = Personanatural::create($d);
        return redirect()->route('personanatural.index')
                ->with('success',['Recordatorio del proceso almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function show(Personanatural $personanatural)
    {

        
        $id = $personanatural->id;
        $personanatural = Personanatural::select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'municipio.nombre AS expedicion_municipio',
                                'departamento.nombre AS expedicion_departamento',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('municipio','municipio_id','=','municipio.id')
                                ->join('departamento','departamento_id','=','departamento.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                                ->findOrFail($id);  

        $Correos = Correo::select('correo.*')->where('correo.personanatural_id', '=', $personanatural->id)
                                ->get();

        $Telefonos = Telefono::select('telefono.*')
                                ->where('telefono.personanatural_id', '=', $personanatural->id)
                                ->get();

        $Documentos = Documento::select('documento.*',
                                'tipodocumento.abreviatura AS tipodocumento')
                                ->join('tipodocumento', 'tipodocumento_id', '=', 'tipodocumento.id')
                                ->where('documento.personanatural_id', '=', $personanatural->id)
                                ->get();
        
        $Clientesproceso = Clienteproceso::select('clienteproceso.id', 'clienteproceso.tipodemanda_id', 
                                'clienteproceso.proceso_id', 'clienteproceso.personanatural_id', 
                                'proceso.estado_id', 'tipodemanda.abreviatura AS tipodemanda', 
                                'proceso.numero AS proceso', 'estado.descripcion AS estado')
                                ->join('tipodemanda', 'tipodemanda_id', '=', 'tipodemanda.id')
                                ->join('proceso', 'proceso.id', '=', 'clienteproceso.proceso_id')
                                ->join('estado', 'proceso.estado_id', '=', 'estado.id')
                                ->where('clienteproceso.personanatural_id', '=', $personanatural->id)
                                ->get();
        
        $Contratos = Contrato::select('pago.contrato_id', 'contrato.numero', 'contrato.valor', 
                                'contrato.tipocontrato_id', 'tipocontrato.descripcion AS tipocontrato',
                                'contrato.proceso_id', 'proceso.numero AS proceso',
                                'contrato.personanatural_id', 'contrato.nombrearchivo',
                                DB::raw("COALESCE(SUM(pago.abono),0) as abono"))
                                ->join('tipocontrato', 'tipocontrato_id', '=', 'tipocontrato.id')
                                ->join('proceso', 'contrato.proceso_id', '=', 'proceso.id')
                                ->leftjoin('pago', 'contrato.id', '=','pago.contrato_id')
                                ->where('contrato.personanatural_id', '=', $personanatural->id)
                                ->groupBy('pago.contrato_id', 'contrato.numero', 'contrato.valor', 
                                'contrato.tipocontrato_id', 'tipocontrato.descripcion', 'pago.abono',
                                'contrato.proceso_id', 'proceso.numero', 
                                'contrato.personanatural_id', 'contrato.nombrearchivo')
                                ->orderBy('pago.contrato_id', 'DESC')
                                ->get();
        
        $Pagos = Contrato::select('contrato.*', 'tipocontrato.descripcion AS tipocontrato',
                                'pago.nrecibo AS nrecibo', 'pago.fecha AS fecha', 'pago.abono AS abono')
                                ->join('tipocontrato', 'tipocontrato_id', '=', 'tipocontrato.id')
                                ->join('pago', 'contrato.id', '=','pago.contrato_id')
                                ->where('contrato.personanatural_id', '=', $personanatural->id)
                                ->get();

        $auditoria = User::findOrFail($personanatural->users_id);


        return view('personanatural.show', compact('auditoria', 'personanatural', 'Contratos', 'Pagos', 
                    'Correos', 'Telefonos', 'Documentos', 'Clientesproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function edit(Personanatural $personanatural)
    {
        $Tiposdocumentosidentificacion = Tipodocumentoidentificacion::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Fondodepensiones = Fondodepension::
            select('id', 'abreviatura', 'descripcion')->orderBy('id', 'ASC')->get();
            $Expediciones = Municipio::
            select('municipio.id', 'municipio.nombre AS municipio', 'departamento.nombre AS departamento')->orderBy('municipio.nombre', 'ASC')
            ->join('departamento','departamento_id','=','departamento.id')
            ->get();
        $Eps = Eps::select('id', 'abreviatura')->orderBy('id', 'ASC')->get();
        $Grados = Grado::select('grado.id', 'grado.abreviatura', 'grado.descripcion', 'fuerza.abreviatura AS fuerza')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->orderBy('fuerza.abreviatura', 'ASC')
                        ->get();
        return view('personanatural.edit', compact('personanatural', 'Tiposdocumentosidentificacion', 'Fondodepensiones', 'Expediciones', 'Eps', 'Grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function update(PersonanaturalFormRequest $request, Personanatural $personanatural)
    {
        
        $personanatural->update($request->all());
        return redirect()->route('personanatural.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida1 = Correo::where('personanatural_id', '=', $id)->get();
        $valida2 = Telefono::where('personanatural_id', '=', $id)->get();
        $valida3 = Documento::where('personanatural_id', '=', $id)->get();
        $valida4 = Clienteproceso::where('personanatural_id', '=', $id)->get();
        if ($valida1->isEmpty() && $valida2->isEmpty() && $valida3->isEmpty() && $valida4->isEmpty()) {
            $personanatural = Personanatural::findOrFail($id);
            if($personanatural->delete())
                return redirect()->route('personanatural.index')->with('success',['Registro borrado completamente']);
        }
        
        $errors = array('No se puede borrar la persona natural');
        if (!$valida1->isEmpty()){
            array_push($errors, 'El proceso tiene correo(s) eletronico(s) asociado(s)');
        }
        if (!$valida2->isEmpty()){
            array_push($errors,'El proceso tiene telefo(s) asociado(s)');
        }
        if (!$valida3->isEmpty()){
            array_push($errors,'El proceso tiene documento(s) asociado(s)');
        }
        if (!$valida4->isEmpty()){
            array_push($errors,'El proceso está asociado con un(os) proceso(s)');
        }
        return redirect()->route('personanatural.index')->withErrors($errors);
        
    }

    public function getCsv(){
        $Personasnaturales = Personanatural::orderBy('personanatural.id', 'ASC')
                                ->select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'municipio.nombre AS expedicion_id_municipio',
                                'municipio.nombre AS expedicion_municipio',
                                'departamento.nombre AS expedicion_departamento',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('municipio','municipio_id','=','municipio.id')
                                ->join('departamento','departamento_id','=','departamento.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')->get();  
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($Personasnaturales, [
            'id',
            'codigo',
            'nombres',
            'apellidopaterno',
            'apellidomaterno',
            'tipodocumentoidentificacion_id',
            'tipodocumentoidentificacion',
            'numerodocumento',
            'expedicion_id_municipio',
            'expedicion_municipio',
            'expedicion_departamento',
            'fechaexpedicion',
            'fechanacimiento',
            'direccion',
            'eps_id',
            'eps',
            'fondodepension_id',
            'fondodepension',
            'grado_id',
            'grado',
            'carrera',
            'fuerza',
            'users_id',
            'created_at',
            'updated_at',
        ])->download();
    }
}
