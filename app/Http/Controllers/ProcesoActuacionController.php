<?php

namespace App\Http\Controllers;

use App\Actuacionproceso;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\ActuacionprocesoFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProcesoActuacionController extends Controller
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
    public function index($proceso_id)
    {
        $Actuacionprocesos = Actuacionproceso::select( 'id',
            'fechaactuacion','actuacion', 'anotacion',
            'nombrearchivo', 'fechainiciatermino', 'fechafinalizatermino', 
            'fecharegistro', 'proceso_id', 
            'users_id', 'created_at', 'updated_at')->where('proceso_id', $proceso_id)->paginate(20);
        return view('proceso.actuacion.index', compact('Actuacionprocesos','proceso_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proceso_id)
    {
        return view('proceso.actuacion.create', compact('proceso_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($proceso_id, ActuacionprocesoFormRequest $request)
    {
        $d = $request->except('_token');

        if ($file = $request->file('nombrearchivo')) {
            $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
            $actuacionproceso = Actuacionproceso::create($request->except('nombrearchivo')
            + ['proceso_id' => $proceso_id]
            + ['nombrearchivo' => $fileName]);
            $path = $file->storeAs('actuaciones/'. $proceso_id, $fileName);
            if (Storage::exists($path)){
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                ->with('success',['data1' => 'Actuación del proceso almacenado completamente', 
                'data2' => 'Archivo de actuación del proceso almacenado completamente']);
            }else{
                return redirect()->route('proceso.actuacion.edit', compact('actuacionproceso', 'proceso_id', 'id'))
                        ->with('success',['Error no se escribio archivo en disco']);
            }
            
        } else {
            Actuacionproceso::create($request->all() 
                + ['proceso_id' => $proceso_id] 
                + ['nombrearchivo' =>'']);
            return redirect()->route('proceso.actuacion.index', $proceso_id)
                ->with('success',['data1' => 'Actuación del proceso almacenado completamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function show($proceso_id, $id, Actuacionproceso $actuacionproceso)
    {
        $actuacionproceso = Actuacionproceso::find($id);
        $auditoria = User::findOrFail($actuacionproceso->users_id)->first();
        return view('proceso.actuacion.show', compact('proceso_id', 'auditoria', 'actuacionproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function edit($proceso_id, $id, Actuacionproceso $actuacionproceso)
    {
        $actuacionproceso = Actuacionproceso::find($id);
        return view('proceso.actuacion.edit', compact('actuacionproceso', 'proceso_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function update($proceso_id, $id, ActuacionprocesoFormRequest $request, Actuacionproceso $actuacionproceso)
    {
        $actuacionproceso =  Actuacionproceso::find($id);
        
        if ($request->options == 0){
            // No hay archivo cargado previo
            if (!is_null($file = $request->file('nombrearchivo'))) {
                // No hay archivo cargado previo pero hay nuevo archivo para actualizar
                $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
                $actuacionproceso->update($request->except('nombrearchivo')
                + ['proceso_id' => $proceso_id]
                + ['nombrearchivo' => $fileName]);
                $path = $file->storeAs('actuaciones/'. $proceso_id, $fileName);
                if (Storage::exists($path)){
                    return redirect()->route('proceso.actuacion.index', $proceso_id)
                    ->with('success',['data1' => 'Actuación del proceso almacenado completamente', 
                    'data2' => 'Archivo de actuación del proceso almacenado completamente']);
                }else{
                    return redirect()->route('proceso.actuacion.edit', compact('actuacionproceso', 'proceso_id', 'id'))
                        ->with('success',['Error no se escribio archivo en disco']);
                }
            } else {
                // No hay archivo cargado previo y no hay nuevo archivo para cargar
                $actuacionproceso->update($request 
                    + ['proceso_id' => $proceso_id] 
                    + ['nombrearchivo' => '']);
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                    ->with('success',['data1' => 'Actuación del proceso almacenado completamente']);
            }
        } else {
            if ($request->options == 1){
                // Hay archivo cargado previo. Se remplaza archivo nuevo a cargar.
                $result = $this->deleteFile($proceso_id, $actuacionproceso->nombrearchivo);
                if (!is_null($file = $request->file('nombrearchivo'))) {
                    $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
                    $actuacionproceso->update($request->except('nombrearchivo')
                    + ['proceso_id' => $proceso_id]
                    + ['nombrearchivo' => $fileName]);
                    $path = $file->storeAs('actuaciones/'. $proceso_id, $fileName);
                    if (Storage::exists($path)){
                        return redirect()->route('proceso.actuacion.index', $proceso_id)
                        ->with('success',['data1' => 'Actuación del proceso almacenado', 
                        'data2' => 'Archivo previo de actuacion borrado completamente',
                        'data3' => 'Se carga un nuevo archivo para la actuación']);
                    }else{
                        return redirect()->route('proceso.actuacion.edit', compact('actuacionproceso', 'proceso_id', 'id'))
                        ->with('success',['Error no se escribio archivo en disco']);
                    }
                } else {
                    $actuacionproceso->update($request->except('nombrearchivo')
                    + ['proceso_id' => $proceso_id]
                    + ['nombrearchivo' => '']);
                    return redirect()->route('proceso.actuacion.index', $proceso_id)
                        ->with('success',['data1' => 'Actuación del proceso almacenado', 
                        'data2' => 'Archivo previo de actuacion borrado completamente',
                        'data3' => 'No se carga un nuevo archivo para la actuación']);
                }
            } else {
                // Hay archivo cargado previo. No hay archivo nuevo para subir
                $actuacionproceso->update($request->except(['nombrearchivo', '_token']) 
                    + ['proceso_id' => $proceso_id]);
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                    ->with('success',['data1' => 'Actuación del proceso almacenado completamente']);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($proceso_id, $id, Actuacionproceso $actuacionproceso)
    {
        $actuacionproceso =  Actuacionproceso::find($id);
        if (!empty($actuacionproceso->nombrearchivo)){
            $result = $this->deleteFile($proceso_id, $actuacionproceso->nombrearchivo);
            $actuacionproceso->delete();
            return redirect()->route('proceso.actuacion.index', $proceso_id)->with('success',
            [
                'data1' => 'Registro borrado completamente',
                'data2' => 'Archivo borrado completamente'
            ]);
        }else {
            $actuacionproceso->delete();
            return redirect()->route('proceso.actuacion.index', $proceso_id)->with('success',['data1' =>  'Registro borrado completamente']);
        }
        
    }

    public function downloadFile($id, $name)
    {
        return Storage::download('actuaciones/'. $id.'/'.$name);
    }

    public function deleteFile($id, $name)
    {
        return Storage::delete('actuaciones/'. $id.'/'.$name);
    }
}
