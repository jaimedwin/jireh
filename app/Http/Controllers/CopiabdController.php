<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use File;

class CopiabdController extends Controller
{
    
    const PATH = 'copiasbasesdedatos/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Storage::allFiles(self::PATH);
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $files = File::files($storagePath.self::PATH);
        $files_name = array();
        foreach ($files as $file){
            array_push($files_name, $file->getFilename());
        }
        return view('copiadb', compact('files_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $respuesta = Artisan::call('db:backup-db');
        return redirect()->route('copiadb.index')->with('success','Copia de la base de datos realizada');
    }

    public function downloadFile($name_file)
    {
        return Storage::download(self::PATH.$name_file);
    }

    public function deleteFile($name_file)
    {
        $respuesta = Storage::delete(self::PATH.$name_file);
        if ($respuesta) {
            return redirect()->route('copiadb.index')->with('success','Se borro el archivo correctamente');
        }else{
            return redirect()->route('copiadb.index')->with('success','no se pudo borrar el archivo');
        }
    }
}
