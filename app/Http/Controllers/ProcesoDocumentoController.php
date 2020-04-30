<?php

namespace App\Http\Controllers;

use App\Models\Documentoproceso;
use App\Models\Tipodocumento;
use App\Models\Proceso;
use App\User;
use App\Http\Requests\DocumentoprocesoFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProcesoDocumentoController extends Controller
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
        print(implode(" ",$palabrasbuscar));
        $documentosproceso = Documentoproceso::orderBy('id', 'ASC')
                        ->select('documentoproceso.*', 
                        'tipodocumento.abreviatura AS tipodocumento', 
                        'proceso.numero')
                        ->join('tipodocumento','tipodocumento_id','=','tipodocumento.id')
                        ->join('proceso','proceso_id','=','proceso.id')
                        ->where('proceso_id', '=', $proceso_id);
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['tipodocumento.abreviatura'];
            $Documentosproceso = $documentosproceso->whereOrSearch($palabrasbuscar, $columnas);
            return view('proceso.documento.index', compact('proceso_id', 'Documentosproceso'))
            ->with('success',['Busqueda realizada']);
        }else{
            $Documentosproceso = $documentosproceso->paginate(10);
            return view('proceso.documento.index', compact('proceso_id', 'Documentosproceso'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($proceso_id)
    {
        $Tipodocumentos = Tipodocumento::select('id', 'abreviatura', 'descripcion')->get();
        $Procesos = Proceso::select('id', 'numero')->get();
        return view('proceso.documento.create', compact('Tipodocumentos', 'proceso_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($proceso_id, DocumentoprocesoFormRequest $request)
    {
        $file = $request->file('nombrearchivo');
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        $documento = Documentoproceso::create($request->except('nombrearchivo')
            + ['nombrearchivo' => $fileName]);
        $path = $file->storeAs(self::PATH. $request->proceso_id, $fileName);
        if (Storage::exists($path) && $documento){
            return redirect()->route('proceso.documento.index', $proceso_id)
                ->with('success',['Información del documento almacenado completamente', 
                'Documento(archivo) almacenado completamente']);
        }else{
            return redirect()->route('proceso.documento.index', $proceso_id)
                ->with('success',['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show($proceso_id, $id)
    {
        $documentoproceso = Documentoproceso::findOrFail($id);
        $auditoria = User::findOrFail($documentoproceso->users_id);
        $tipodocumento = Tipodocumento::select('abreviatura')->findOrFail($documentoproceso->tipodocumento_id);
        return view('proceso.documento.show', compact('proceso_id', 'tipodocumento', 'documentoproceso', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit($proceso_id, $id)
    {
        $documentoproceso = Documentoproceso::findOrFail($id);
        $Tipodocumentos = Tipodocumento::select('id', 'abreviatura', 'descripcion')->get();
        return view('proceso.documento.edit', compact('proceso_id', 'Tipodocumentos', 'documentoproceso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update($proceso_id, $id, DocumentoprocesoFormRequest $request)
    {
        $documentoproceso = Documentoproceso::findOrFail($id);
        $file = $request->file('nombrearchivo');
        $nombrearchivo_anterior = $request->nombrearchivo_anterior;
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        
        $documentoproceso = $documentoproceso->update($request->except('nombrearchivo')
            + ['nombrearchivo' => $fileName]);
        
        $path = $file->storeAs(self::PATH. $request->proceso_id, $fileName);
        $result = $this->deleteFile($proceso_id, $nombrearchivo_anterior);
        if (Storage::exists($path) && $documentoproceso){
            return redirect()->route('proceso.documento.index', $proceso_id)
            ->with('success',['Registro del documento actualizado', 
            'Archivo previo borrado completamente: '. $nombrearchivo_anterior,
            'Se carga nuevo archivo: '. $fileName]);
        }else{
            return redirect()->route('proceso.documento.index', $proceso_id)
            ->withErrors(['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($proceso_id, $id)
    {
        $documentoproceso = Documentoproceso::findOrFail($id);
        
        $result1 = $documentoproceso->delete();
        $result2 = $this->deleteFile($documentoproceso->proceso_id, $documentoproceso->nombrearchivo);
        if($result1 && $result2)
            return redirect()->route('proceso.documento.index', $proceso_id)->with('success',
                [ 'Registro borrado completamente', 'Archivo en la ruta '. $documentoproceso->nombrearchivo . 'borrado completamente '
                ]);
        $errors = array('No se puede borrar completamente el registro');
        if (!$result1->isEmpty()){
            array_push($errors, 'Error al borrar el registro de la base de datos');
        }
        if (!$result2->isEmpty()){
            array_push($errors, 'Error al borrar el archivo en la ruta '. $documentoproceso->nombrearchivo);
        }
        return redirect()->route('proceso.documento.index', $proceso_id)->withErrors($errors);
    }

    public function downloadFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::download(self::PATH. $id.'/'.$name);
        }
        return redirect()->route('proceso.documento.index', $id)->withErrors(['No se encuentra el archivo: '. $name]);
    }

    public function deleteFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::delete(self::PATH. '/'. $id.'/'.$name);
        }
        return redirect()->route('proceso.documento.index', $id)->withErrors(['No se encuentra el archivo: '. $name]);
    }
}
