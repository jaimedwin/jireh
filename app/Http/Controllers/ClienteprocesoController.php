<?php

namespace App\Http\Controllers;

use App\Models\Clienteproceso;
use App\Models\Personanatural;
use App\Models\Proceso;
use App\Models\Tipodemanda;
use App\Models\Box;
use App\Models\Correo;
use App\Models\Telefono;
use App\Models\Documento;
use App\Models\Documentoproceso;
use App\Models\Contrato;
use App\Models\Actuacionproceso;
use App\User;
use App\Http\Requests\ClienteprocesoFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteprocesoController extends Controller
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
        $clientesprocesos = Clienteproceso::orderBy('id', 'DESC')
                        ->select('clienteproceso.*', 'proceso.numero AS proceso_numero', 
                        'proceso.codigo AS proceso_codigo', 
                        'tipodemanda.abreviatura AS tipodemanda', 
                        'personanatural.numerodocumento AS numerodocumento',
                        'box.abreviatura AS box')
                        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('proceso','proceso_id','=','proceso.id')
                        ->join('personanatural','personanatural_id','=','personanatural.id')
                        ->join('tipodemanda','tipodemanda_id','=','tipodemanda.id')
                        ->leftjoin('box','box_id','=','box.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['proceso.numero', 'proceso.codigo', 'tipodemanda.abreviatura', 
            'personanatural.numerodocumento', 'personanatural.nombres', 
            'personanatural.apellidopaterno', 'personanatural.apellidomaterno', 'box.abreviatura'];
            $Clientesprocesos['Clientesprocesos'] = $clientesprocesos->whereOrSearch($palabrasbuscar, $columnas);
            return view('clienteproceso.index', $Clientesprocesos)
            ->with('success',['Busqueda realizada']);
        }else{
            $Clientesprocesos['Clientesprocesos'] = $clientesprocesos->paginate(10);
            return view('clienteproceso.index', $Clientesprocesos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        $Procesos = Proceso::select('id', 'codigo', 'numero')->get();
        $Tiposdemandas = Tipodemanda::select('id', 'abreviatura', 'descripcion')->get();
        $Boxs = Box::select('id', 'abreviatura', 'descripcion')->get();
        return view('clienteproceso.create', compact('Personasnaturales', 'Procesos', 'Tiposdemandas', 'Boxs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteprocesoFormRequest $request)
    {
        $clienteproceso = Clienteproceso::create($request->except('_token'));
        return redirect()->route('clienteproceso.index')
                ->with('success',['Registro del proceso almacenada completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function show(Clienteproceso $clienteproceso)
    {
        $auditoria = User::findOrFail($clienteproceso->users_id);
        $Clienteproceso = Clienteproceso::select('clienteproceso.*', 
                            'proceso.numero AS proceso', 
                            'tipodemanda.abreviatura AS tipodemanda',
                            'box.abreviatura AS box')
                            ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
                            ->join('personanatural','personanatural_id','=','personanatural.id')
                            ->join('proceso','proceso_id','=','proceso.id')
                            ->join('tipodemanda','tipodemanda_id','=','tipodemanda.id')
                            ->join('box','box_id','=','box.id')
                            ->findOrFail($clienteproceso->id);
        $Personanatural = Personanatural::select('personanatural.*',
                        'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                        'municipio.nombre AS municipio',
                        'departamento.nombre AS departamento',
                        'eps.abreviatura AS eps', 
                        'eps.descripcion AS eps_descripcion', 
                        'grado.abreviatura AS grado',
                        'carrera.descripcion AS carrera',
                        'fuerza.abreviatura AS fuerza', 
                        'fondodepension.abreviatura AS fondodepension')
                        ->join('tipodocumentoidentificacion', 'tipodocumentoidentificacion_id', '=', 'tipodocumentoidentificacion.id')
                        ->join('municipio','municipio_id','=','municipio.id')
                        ->join('departamento','departamento_id','=','departamento.id')
                        ->join('eps','eps_id','=','eps.id')
                        ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                        ->join('grado','grado_id','=','grado.id')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->findOrFail($clienteproceso->personanatural_id);
        $Correos = Correo::select('correo.*')->where('correo.personanatural_id', '=', $clienteproceso->personanatural_id)->get();
        $Telefonos = Telefono::select('telefono.*')->where('telefono.personanatural_id', '=', $clienteproceso->personanatural_id)->get();
        $Documentos = Documento::select('documento.*',
                        'tipodocumento.abreviatura AS tipodocumento',
                        'tipodocumento.descripcion AS tipodocumento_descripcion')
                        ->join('tipodocumento', 'tipodocumento_id', '=', 'tipodocumento.id')
                        ->where('documento.personanatural_id', '=', $clienteproceso->personanatural_id)
                        ->get();
        
        $Contratos = Contrato::select('pago.contrato_id', 'contrato.numero', 'contrato.valor', 
                        'contrato.tipocontrato_id', 'tipocontrato.descripcion AS tipocontrato',
                        'contrato.personanatural_id', 'contrato.nombrearchivo',
                        DB::raw("COALESCE(SUM(pago.abono),0) as abono"))
                        ->join('tipocontrato', 'tipocontrato_id', '=', 'tipocontrato.id')
                        ->leftjoin('pago', 'contrato.id', '=','pago.contrato_id')
                        ->where('contrato.personanatural_id', '=', $clienteproceso->personanatural_id)
                        ->where('contrato.proceso_id', '=', $clienteproceso->proceso_id)
                        ->groupBy('pago.contrato_id', 'contrato.numero', 'contrato.valor', 
                        'contrato.tipocontrato_id', 'tipocontrato.descripcion',
                        'contrato.personanatural_id', 'contrato.nombrearchivo')
                        ->orderBy('pago.contrato_id', 'DESC')
                        ->get();
        
        $Pagos = Contrato::select('contrato.*', 'tipocontrato.descripcion AS tipocontrato',
                        'pago.nrecibo AS nrecibo', 'pago.fecha AS fecha', 'pago.abono AS abono')
                        ->join('tipocontrato', 'tipocontrato_id', '=', 'tipocontrato.id')
                        ->join('pago', 'contrato.id', '=','pago.contrato_id')
                        ->where('contrato.personanatural_id', '=', $clienteproceso->personanatural_id)
                        ->where('contrato.proceso_id', '=', $clienteproceso->proceso_id)
                        ->get();

        $Proceso = Proceso::select('proceso.*',
                        'ciudadproceso.nombre AS ciudadproceso', 
                        'corporacion.nombre AS corporacion', 
                        'ponente.nombrecompleto AS ponente', 
                        'estado.descripcion AS estado')
                        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
                        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
                        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
                        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
                        ->findOrFail($clienteproceso->proceso_id);

        $Actuacionesproceso = Actuacionproceso::orderBy( 'fechaactuacion', 'DESC')
                        ->where('proceso_id', '=', $clienteproceso->proceso_id)->get();
        

        $Documentosproceso = Documentoproceso::select('documentoproceso.*',
                        'tipodocumento.abreviatura AS tipodocumento',
                        'tipodocumento.descripcion AS tipodocumento_descripcion')
                        ->join('tipodocumento', 'tipodocumento_id', '=', 'tipodocumento.id')
                        ->where('documentoproceso.proceso_id', '=', $clienteproceso->proceso_id)
                        ->get();

        return view('clienteproceso.show', compact('Clienteproceso', 'auditoria', 
                'Personanatural', 'Proceso', 'Correos', 'Correos', 'Telefonos', 
                'Documentos', 'Documentosproceso', 'Contratos', 'Pagos', 'Actuacionesproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Clienteproceso $clienteproceso)
    {
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        $Procesos = Proceso::select('id', 'codigo', 'numero')->get();
        $Tiposdemandas = Tipodemanda::select('id', 'abreviatura', 'descripcion')->get();
        $Boxs = Box::select('id', 'abreviatura', 'descripcion')->get();
        return view('clienteproceso.edit', compact('clienteproceso', 'Personasnaturales', 'Procesos', 'Tiposdemandas', 'Boxs'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clienteproceso $clienteproceso)
    {
        $clienteproceso->update($request->all());
        return redirect()->route('clienteproceso.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clienteproceso = Clienteproceso::findOrFail($id);
        if ($clienteproceso->delete())
            return redirect()->route('clienteproceso.index')->with('success',['Registro borrado completamente']);
        return redirect()->route('clienteproceso.index')->withErrors(['No se puede borrar el clienteproceso']);

    }

    public function getCsv(){
        $Clientesprocesos = Clienteproceso::orderBy('clienteproceso.id', 'ASC')
                        ->select('clienteproceso.id AS clienteproceso_id', 
                            'clienteproceso.*', 'proceso.*' , 'personanatural.*',
                            'personanatural.codigo AS codigo_personanatural',
                            //'telefono.numero AS numero_de_telefono',
                            //'correo.electronico AS correo_electronico',
                            'fondodepension.abreviatura AS fondodepension',
                            'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                            'municipio.id AS municipio_id',
                            'municipio.nombre AS expedicion_municipio',
                            'departamento.nombre AS expedicion_departamento',
                            'eps.abreviatura AS eps', 
                            'grado.abreviatura AS grado',
                            'carrera.descripcion AS carrera',
                            'fuerza.abreviatura AS fuerza',
                            'proceso.codigo AS codigo_proceso',
                            'proceso.numero AS numero_proceso',
                            'ciudadproceso.nombre AS ciudadproceso', 
                            'corporacion.nombre AS corporacion', 
                            'ponente.nombrecompleto AS ponente', 
                            'estado.descripcion AS estado',
                            'ciudadproceso.nombre AS ciudadproceso', 
                            'corporacion.nombre AS corporacion', 
                            'ponente.nombrecompleto AS ponente', 
                            'estado.descripcion AS estado',
                            'clienteproceso.tipodemanda_id AS tipodemanda_id',
                            'tipodemanda.abreviatura AS tipodemanda',
                            'clienteproceso.created_at AS created_at',
                            'clienteproceso.updated_at AS updated_at')
                        ->selectRaw('group_concat(distinct telefono.numero separator ", ") AS numero_de_telefono')
                        ->selectRaw('group_concat(distinct correo.electronico separator ", ") AS correo_electronico')
                        ->join('personanatural','personanatural_id','=','personanatural.id')
                        ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                        ->join('municipio','municipio_id','=','municipio.id')
                        ->join('departamento','departamento_id','=','departamento.id')
                        ->join('eps','eps_id','=','eps.id')
                        ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                        ->join('grado','grado_id','=','grado.id')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->join('proceso','proceso_id','=','proceso.id')
                        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
                        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
                        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
                        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
                        ->join('tipodemanda','tipodemanda_id','=','tipodemanda.id')
                        ->leftjoin('telefono', 'personanatural.id', '=', 'telefono.personanatural_id')
                        ->leftjoin('correo', 'personanatural.id', '=', 'correo.personanatural_id')
                        ->groupBy('clienteproceso.id', 
                            'clienteproceso.personanatural_id',
                            'clienteproceso.proceso_id',
                            'clienteproceso.tipodemanda_id',
                            'clienteproceso.users_id',
                            'clienteproceso.created_at',
                            'clienteproceso.updated_at',
                            'clienteproceso.box_id',
                            'proceso.id',
                            'proceso.codigo',
                            'proceso.numero',
                            'proceso.ciudadproceso_id',
                            'proceso.corporacion_id',
                            'proceso.ponente_id',
                            'proceso.estado_id',
                            'proceso.users_id',
                            'proceso.created_at',
                            'proceso.updated_at',
                            'personanatural.id',
                            'personanatural.contrato',
                            'personanatural.codigo',
                            'personanatural.nombres',
                            'personanatural.apellidopaterno',
                            'personanatural.apellidomaterno',
                            'personanatural.tipodocumentoidentificacion_id',
                            'personanatural.numerodocumento',
                            'personanatural.municipio_id',
                            'personanatural.fechaexpedicion',
                            'personanatural.fechanacimiento',
                            'personanatural.direccion',
                            'personanatural.eps_id',
                            'personanatural.fondodepension_id',
                            'personanatural.grado_id',
                            'personanatural.users_id',
                            'personanatural.created_at',
                            'personanatural.updated_at',
                            'fondodepension.abreviatura',
                            'tipodocumentoidentificacion.abreviatura',
                            'municipio.id',
                            'municipio.nombre',
                            'departamento.nombre',
                            'eps.abreviatura',
                            'grado.abreviatura',
                            'carrera.descripcion',
                            'fuerza.abreviatura',
                            'fuerza.abreviatura',
                            'ciudadproceso.nombre',
                            'corporacion.nombre',
                            'ponente.nombrecompleto',
                            'estado.descripcion',
                            'tipodemanda.abreviatura')
                        ->get();  
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($Clientesprocesos, [
            'clienteproceso_id',
            'codigo_personanatural',
            'nombres',
            'apellidopaterno',
            'apellidomaterno',
            'numero_de_telefono',
            'correo_electronico',
            'tipodocumentoidentificacion_id',
            'tipodocumentoidentificacion',
            'numerodocumento',
            'municipio_id',
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
            'codigo_proceso',
            'numero_proceso',
            'ciudadproceso_id',
            'ciudadproceso',
            'corporacion_id',
            'corporacion',
            'ponente_id',
            'ponente',
            'estado_id',
            'estado',
            'tipodemanda_id',
            'tipodemanda',
            'users_id',
            'created_at',
            'updated_at',
        ])->download();
    }
}
