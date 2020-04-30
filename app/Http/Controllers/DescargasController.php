<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class DescargasController extends Controller
{
    public function downloadFileOtrosdocumentos($id, $name)
    {
        $file = Storage::exists('otrosdocumentos/'. $id.'/'. $name);
        if ($file){
            return Storage::download('otrosdocumentos/'. $id.'/'.$name);
        }
        
        return redirect()->route('admin')->withErrors(['No se encuentra el archivo: '. $name]);
    }
}
