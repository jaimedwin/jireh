<?php

namespace App\Http\Controllers;

use App\Tipodocumento;
use App\User;
use App\Http\Requests\TipodocumentoFormRequest;
use Illuminate\Http\Request;

class TipodocumentoController extends Controller
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
            $tipodocumentos['tipodocumentos'] = Tipodocumento::orderBy('id', 'DESC')
                    ->orwhere('abreviatura', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('comentario', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('tipodocumento.index', $tipodocumentos)->with('success','Busqueda realizada');
        }else{
            $tipodocumentos['tipodocumentos'] = Tipodocumento::paginate(10);
            return view('tipodocumento.index', $tipodocumentos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipodocumento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipodocumentoFormRequest $request)
    {
        $d = $request->except('_token');
        Tipodocumento::create($d);
        return redirect()->route('tipodocumento.index')->with('success','Tipo de documentos almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipodocumento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function show(Tipodocumento $tipodocumento)
    {
        $auditoria = User::findOrFail($tipodocumento)->first();
        return view('tipodocumento.show', compact('tipodocumento', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipodocumento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipodocumento $tipodocumento)
    {
        return view('tipodocumento.edit', compact('tipodocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipodocumento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function update(TipodocumentoFormRequest $request, Tipodocumento $tipodocumento)
    {
        $tipodocumento->update($request->all());
        return redirect()->route('tipodocumento.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipodocumento  $tipodocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipodocumento $tipodocumento)
    {
        $tipodocumento->delete();
        return redirect()->route('tipodocumento.index')->with('success','Registro borrado completamente');
    }
}
