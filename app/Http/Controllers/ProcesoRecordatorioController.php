<?php

namespace App\Http\Controllers;

use App\Recordatorioproceso;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\RecordatorioprocesoFormRequest;
use Illuminate\Http\Request;


class ProcesoRecordatorioController extends Controller
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
    public function index($proceso_id, Request $request)
    {
        $buscar =  $request->post('buscar'); 
        if ($buscar){
            $Recordatorioprocesos = Recordatorioproceso::select( 'id',
            'observacion', 'fecha','users_id', 'created_at', 'updated_at')
            ->orwhere('observacion', 'LIKE', '%'. $buscar. '%')
            ->orwhere('fecha', 'LIKE', '%'. $buscar. '%')
            ->where('proceso_id', $proceso_id)
            ->paginate(10);
            return view('proceso.recordatorio.index', compact('Recordatorioprocesos','proceso_id'))
            ->with('success','Busqueda realizada');
        }else{
            $Recordatorioprocesos = Recordatorioproceso::select( 'id',
            'observacion', 'fecha','users_id', 'created_at', 'updated_at')
            ->where('proceso_id', $proceso_id)->paginate(10);
            return view('proceso.recordatorio.index', compact('Recordatorioprocesos','proceso_id'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proceso_id)
    {
        return view('proceso.recordatorio.create', compact('proceso_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($proceso_id, RecordatorioprocesoFormRequest $request)
    {
        $d = $request->except('_token');
        $recordatorioproceso = Recordatorioproceso::create($d);
        return redirect()->route('proceso.recordatorio.index', $proceso_id)
                ->with('success',['data1' => 'Recordatorio del proceso almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recordatorioproceso  $recordatorioproceso
     * @return \Illuminate\Http\Response
     */
    public function show($proceso_id, $id, Recordatorioproceso $recordatorioproceso)
    {
        $recordatorioproceso = Recordatorioproceso::find($id);
        $auditoria = User::findOrFail($recordatorioproceso->users_id)->first();
        return view('proceso.recordatorio.show', compact('proceso_id', 'auditoria', 'recordatorioproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recordatorioproceso  $recordatorioproceso
     * @return \Illuminate\Http\Response
     */
    public function edit($proceso_id, $id, Recordatorioproceso $recordatorioproceso)
    {
        $recordatorioproceso = Recordatorioproceso::find($id);
        return view('proceso.recordatorio.edit', compact('recordatorioproceso', 'proceso_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recordatorioproceso  $recordatorioproceso
     * @return \Illuminate\Http\Response
     */
    public function update($proceso_id, $id, RecordatorioprocesoFormRequest $request, Recordatorioproceso $recordatorioproceso)
    {
        $recordatorioproceso = Recordatorioproceso::find($id);
        $recordatorioproceso->update($request->except('_token'));
        return redirect()->route('proceso.recordatorio.index', $proceso_id)
                    ->with('success',['data1' => 'Recordatorio del proceso actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recordatorioproceso  $recordatorioproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($proceso_id, $id, Recordatorioproceso $recordatorioproceso)
    {
        $recordatorioproceso =  Recordatorioproceso::find($id);
        $recordatorioproceso->delete();
        return redirect()->route('proceso.recordatorio.index', $proceso_id)->with('success',['data1' =>  'Registro borrado completamente']);
    }
}
