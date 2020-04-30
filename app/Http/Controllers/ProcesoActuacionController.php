<?php

namespace App\Http\Controllers;

use App\Models\Actuacionproceso;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\ActuacionprocesoFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProcesoActuacionController extends Controller
{
    const PATH = 'actuaciones/';

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
        $palabrasbuscar = explode(" ",$request->post('buscar')); 

        $actuacionprocesos = Actuacionproceso::select( 'actuacionproceso.*')
                                ->orderBy( 'fechaactuacion', 'DESC')
                                ->where('proceso_id', $proceso_id);

        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){  
            $columnas = ['actuacion', 'anotacion', 'fechaactuacion', 
            'fechainiciatermino', 'fechafinalizatermino', 'fecharegistro'];
            $Actuacionprocesos = $actuacionprocesos->whereOrSearch($palabrasbuscar, $columnas);
            return view('proceso.actuacion.index', compact('Actuacionprocesos','proceso_id'));


            return view('proceso.index', $Actuacionprocesos)->with('success',['Busqueda realizada']);
        }else{
            $Actuacionprocesos = $actuacionprocesos->paginate(10);
            return view('proceso.actuacion.index', compact('Actuacionprocesos','proceso_id'));
        }
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
            $path = $file->storeAs(self::PATH. $proceso_id, $fileName);
            if (Storage::exists($path)){
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                ->with('success',['Actuación del proceso almacenado completamente', 
                'Archivo de actuación del proceso almacenado completamente']);
            }else{
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                        ->with('success',['Error no se escribio archivo en disco']);
            }
        } else {
            Actuacionproceso::create($request->all() 
                + ['proceso_id' => $proceso_id] 
                + ['nombrearchivo' =>'']);
            return redirect()->route('proceso.actuacion.index', $proceso_id)
                ->with('success',['Actuación del proceso almacenado completamente']);
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
        $actuacionproceso = Actuacionproceso::findOrFail($id);
        $auditoria = User::findOrFail($actuacionproceso->users_id);
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
        $actuacionproceso = Actuacionproceso::findOrFail($id);
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
        $actuacionproceso =  Actuacionproceso::findOrFail($id);
        
        if ($request->options == 0){
            // No hay archivo cargado previo
            if (!is_null($file = $request->file('nombrearchivo'))) {
                // No hay archivo cargado previo pero hay nuevo archivo para actualizar
                $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
                $actuacionproceso->update($request->except('nombrearchivo')
                + ['proceso_id' => $proceso_id]
                + ['nombrearchivo' => $fileName]);
                $path = $file->storeAs(self::PATH . $proceso_id, $fileName);
                if (Storage::exists($path)){
                    return redirect()->route('proceso.actuacion.index', $proceso_id)
                    ->with('success',['Actuación del proceso actualizado completamente', 
                    'Archivo de actuación del proceso almacenado completamente']);
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
                    ->with('success',['Actuación del proceso actualizado completamente']);
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
                    $path = $file->storeAs(self::PATH. $proceso_id, $fileName);
                    if (Storage::exists($path)){
                        return redirect()->route('proceso.actuacion.index', $proceso_id)
                        ->with('success',['Actuación del proceso actualizado', 
                        'Archivo previo de actuacion borrado completamente',
                        'Se carga un nuevo archivo para la actuación']);
                    }else{
                        return redirect()->route('proceso.actuacion.edit', compact('actuacionproceso', 'proceso_id', 'id'))
                        ->with('success',['Error no se escribio archivo en disco']);
                    }
                } else {
                    $actuacionproceso->update($request->except('nombrearchivo')
                    + ['proceso_id' => $proceso_id]
                    + ['nombrearchivo' => '']);
                    return redirect()->route('proceso.actuacion.index', $proceso_id)
                        ->with('success',['Actuación del proceso actualizado', 
                        'Archivo previo de actuacion borrado completamente',
                        'No se carga un nuevo archivo para la actuación']);
                }
            } else {
                // Hay archivo cargado previo. No hay archivo nuevo para subir
                $actuacionproceso->update($request->except(['nombrearchivo', '_token']) 
                    + ['proceso_id' => $proceso_id]);
                return redirect()->route('proceso.actuacion.index', $proceso_id)
                    ->with('success',['Actuación del proceso actualizado completamente']);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actuacionproceso  $actuacionproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($proceso_id, $id)
    {
        $actuacionproceso =  Actuacionproceso::findOrFail($id);
        if (!empty($actuacionproceso->nombrearchivo)){
            $result1 = $this->deleteFile($proceso_id, $actuacionproceso->nombrearchivo);
            $result2 = $actuacionproceso->delete();
            if ($result1 && $result2)
                return redirect()->route('proceso.actuacion.index', $proceso_id)->with('success',
                [ 'Registro borrado completamente', 'Archivo borrado completamente'
                ]);
        }else{
            $result1 = false;
            $result2 = $actuacionproceso->delete();
            if ($result2)
                return redirect()->route('proceso.actuacion.index', $proceso_id)->with('success',
                ['Registro borrado completamente']);
        }
        $errors = array('Error al borrar la actuación');
        if ($result1){
            array_push($errors, 'El registro de la acutuacion del proceso en la base de datos no se pudo borrar');
        }
        if ($result2){
            array_push($errors, 'El archivo '. $actuacionproceso->nombrearchivo. ' no se pudo borrar');
        }
        return redirect()->route('proceso.actuacion.index', $proceso_id)->withErrors($errors);
        
        
    }

    public function downloadFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::download(self::PATH. $id.'/'.$name);
        }
        return redirect()->route('proceso.actuacion.index', $id)->withErrors(['No se encuentra el archivo: '. $name]);
    }

    public function deleteFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::delete(self::PATH. $id.'/'.$name);
        }
        return redirect()->route('proceso.actuacion.index', $id)->withErrors(['No se encuentra el archivo: '. $name]);
    }

    public function getCsv($proceso_id){
        $actuacionprocesos = Actuacionproceso::select( 'actuacionproceso.*')
        ->where('proceso_id', $proceso_id)->get();  
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($actuacionprocesos, [
            'id',
            'fechaactuacion',
            'actuacion',
            'anotacion',
            'nombrearchivo',
            'fechainiciatermino',
            'fechafinalizatermino',
            'fecharegistro',
            'proceso_id',
            'users_id',
            'created_at',
            'updated_at',
        ])->download();
    }
}
