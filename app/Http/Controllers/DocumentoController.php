<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Tipodocumento;
use App\Models\Personanatural;
use App\User;
use App\Http\Requests\DocumentoFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
//use Illuminate\Contracts\Filesystem\FileNotFoundException;
//use Illuminate\Http\File;

class DocumentoController extends Controller
{
    const PATH = 'otrosdocumentos/';

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
        print(implode(" ",$palabrasbuscar));
        $documentos = Documento::orderBy('id', 'ASC')
                        ->select('documento.*', 
                        'tipodocumento.descripcion AS tipodocumento_descripcion',
                        'tipodocumento.abreviatura AS tipodocumento_abreviatura', 
                        'personanatural.numerodocumento AS numerodocumento')
                        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('tipodocumento','tipodocumento_id','=','tipodocumento.id')
                        ->join('personanatural','personanatural_id','=','personanatural.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['tipodocumento.abreviatura', 
            'personanatural.nombres', 'personanatural.apellidopaterno', 
            'personanatural.apellidomaterno', 'personanatural.numerodocumento'];
            $Documentos['Documentos'] = $documentos->whereOrSearch($palabrasbuscar, $columnas);
            return view('documento.index', $Documentos)
            ->with('success',['Busqueda realizada']);
        }else{
            $Documentos['Documentos'] = $documentos->paginate(10);
            return view('documento.index', $Documentos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Tipodocumentos = Tipodocumento::select('id', 'abreviatura', 'descripcion')->get();
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')->get();
        return view('documento.create', compact('Tipodocumentos', 'Personasnaturales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentoFormRequest $request)
    {
        $file = $request->file('nombrearchivo');
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        $documento = Documento::create($request->except('nombrearchivo')
            + ['nombrearchivo' => $fileName]);
        $path = $file->storeAs(self::PATH. $request->personanatural_id, $fileName);
        if (Storage::exists($path)){
            return redirect()->route('documento.index')
                ->with('success',['Información del documento almacenado completamente', 
                'Documento(archivo) almacenado completamente']);
        }else{
            return redirect()->route('documento.index')
                ->with('success',['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        $auditoria = User::findOrFail($documento->users_id);
        $tipodocumento = Tipodocumento::select('abreviatura')->findOrFail($documento->tipodocumento_id);
        $personanatural = Personanatural::selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')->findOrFail($documento->personanatural_id);
        return view('documento.show', compact('tipodocumento', 'documento', 'personanatural', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        $Tipodocumentos = Tipodocumento::select('id', 'abreviatura', 'descripcion')->get();
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        return view('documento.edit', compact('documento', 'Tipodocumentos', 'Personasnaturales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentoFormRequest $request, Documento $documento)
    {
        $file = $request->file('nombrearchivo');
        $nombrearchivo_anterior = $request->nombrearchivo_anterior;
        $personanatural_anterior = $request->personanatural_anterior;
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        
        $documentos = $documento->update($request->except('nombrearchivo', 'personanatural_anterior')
            + ['nombrearchivo' => $fileName]);
        
        $path = $file->storeAs(self::PATH. $request->personanatural_id, $fileName);
        $result = $this->deleteFile($personanatural_anterior, $nombrearchivo_anterior);
        if (Storage::exists($path)){
            return redirect()->route('documento.index')
            ->with('success',['Registro del documento actualizado', 
            'Archivo previo borrado completamente: '. $nombrearchivo_anterior,
            'Se carga nuevo archivo: '. $fileName]);
        }else{
            return redirect()->route('documento.index')
            ->withErrors(['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);   
        $result1 = $documento->delete();
        $result2 = $this->deleteFile($documento->personanatural_id, $documento->nombrearchivo);
        if($result1 && $result2)
            return redirect()->route('documento.index')->with('success',
                [ 'Registro borrado completamente', 'Archivo en la ruta '. $documento->nombrearchivo . ' borrado completamente '
                ]);
        $errors = array('No se puede borrar completamente el registro');
        if (!$result1->isEmpty()){
            array_push($errors, 'Error al borrar el registro de la base de datos');
        }
        if (!$result2->isEmpty()){
            array_push($errors, 'Error al borrar el archivo en la ruta'. $documento->nombrearchivo);
        }
        return redirect()->route('documento.index')->withErrors($errors);
    }

    public function downloadFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::download(self::PATH. $id.'/'.$name);
        }
        
        return redirect()->route('documento.index')->withErrors(['No se encuentra el archivo: '. $name]);
    }

    public function deleteFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::delete(self::PATH. $id.'/'.$name);
        }
            
        return redirect()->route('documento.index')->withErrors(['No se encuentra el archivo: '. $name]);
    }
}
