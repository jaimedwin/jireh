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
        $buscar =  $request->post('buscar'); 
        if ($buscar){
            $procesos= $this->getProcesoJoin(100, $buscar);
            return view('proceso.index', $procesos)->with('success','Busqueda realizada');
        }else{
            $procesos = $this->getProcesoJoin(10);
            return view('proceso.index', $procesos);
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

    private function getConsulta($pag, $buscar = null){
        
        $consultas['Consultas'] = Proceso::addSelect(
            [
                'ciudadproceso' => Ciudadproceso::select('nombre')
                ->whereColumn('ciudadproceso_id', 'ciudadproceso.id')
                ->limit(1)
            ]
        )->addSelect(
            [
                'corporacion' => Corporacion::select('nombre')
                ->whereColumn('corporacion_id', 'corporacion.id')
                ->limit(1)
            ]
        )->addSelect(
            [
                'ponente' => Ponente::select('nombrecompleto')
                ->whereColumn('ponente_id', 'ponente.id')
                ->limit(1)
            ]
        )->addSelect(
            [
                'estado' => Estado::select('descripcion')
                ->whereColumn('estado_id', 'estado.id')
                ->limit(1)
            ]
        )
        ->orwhere('codigo', 'LIKE', '%'. $buscar. '%')
        ->orwhere('numero', 'LIKE', '%'. $buscar. '%')
        ->paginate($pag);
        
        return $consultas;
    }

    private function getProcesoJoin1($pag, $buscar = null){
        
        $consulta0 = Proceso::select(
            'proceso.id','proceso.numero', 'proceso.codigo',
            'ciudadproceso.nombre AS ciudadproceso', 
            'corporacion.nombre AS corporacion', 
            'ponente.nombrecompleto AS ponente', 
            'estado.descripcion AS estado')
        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
        ->leftjoin('actuacionproceso', 'actuacionproceso.proceso_id', '=', 'proceso.id')
        ->selectRaw('COALESCE(count(actuacionproceso.proceso_id),0) AS total_actuacion')
        ->whereNotNull('actuacionproceso.proceso_id')
        ->groupBy('proceso.id', 'proceso.codigo', 'proceso.numero', 
        'proceso.ponente_id', 'proceso.estado_id',
        'ciudadproceso.nombre', 'corporacion.nombre', 
        'ponente.nombrecompleto', 'estado.descripcion', 'total_actuacion');

        //print_r($consulta0);
        print_r($consulta0);
        //$consultas['Consultas'] = Proceso::leftjoin(
        //    'recordatorio', 'proceso.id', '=', 'recordatorio.proceso_id')
        //->selectRaw('COALESCE(count(recordatorio.proceso_id),0) as total_recordatorio')
        //->whereNotNull('recordatorio.proceso_id')
        //->unionAll($consulta0)
        //->orwhere('codigo', 'LIKE', '%'. $buscar. '%')
        //->orwhere('numero', 'LIKE', '%'. $buscar. '%')
        //->groupBy('proceso.id', 'proceso.codigo', 'proceso.numero', 
        //'proceso.ponente_id', 'proceso.estado_id',
        //'ciudadproceso.nombre', 'corporacion.nombre', 
        //'ponente.nombrecompleto', 'estado.descripcion')->paginate($pag);

        //dd($consultas);
        // ['Consultas']
        // ->leftjoin('recordatorio', 'proceso.id', '=', 'recordatorio.proceso_id')
        // ->selectRaw('COALESCE(count(recordatorio.proceso_id),0) as total_recordatorio')
        // ->whereNotNull('recordatorio.proceso_id')
        // ->paginate($pag);
        return $consultas;
    }

    private function getProcesoJoin($pag, $buscar = null){
        
        $consultas['Consultas'] = Proceso::select(
            'proceso.id','proceso.numero', 'proceso.codigo',
            'ciudadproceso.nombre AS ciudadproceso', 
            'corporacion.nombre AS corporacion', 
            'ponente.nombrecompleto AS ponente', 
            'estado.descripcion AS estado')
        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
        ->leftjoin('actuacionproceso', 'actuacionproceso.proceso_id', '=', 'proceso.id')
        ->selectRaw('COALESCE(count(actuacionproceso.proceso_id),0) as total_actuacion')
        ->whereNotNull('actuacionproceso.proceso_id')
        ->orwhere('codigo', 'LIKE', '%'. $buscar. '%')
        ->orwhere('numero', 'LIKE', '%'. $buscar. '%')
        ->groupBy('proceso.id', 'proceso.codigo', 'proceso.numero', 
        'proceso.ponente_id', 'proceso.estado_id',
        'ciudadproceso.nombre', 'corporacion.nombre', 
        'ponente.nombrecompleto', 'estado.descripcion')->paginate($pag);


        return $consultas;
    }
    private function getNumeroactuacionesJoin($proceso_id){
        $consultas = Actuacionproceso::where('proceso_id', $proceso_id)->count();
        return $consultas;
    }
}
