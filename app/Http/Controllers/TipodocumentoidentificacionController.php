<?php

namespace App\Http\Controllers;

use App\Models\Tipodocumentoidentificacion;
use App\User;
use App\Http\Requests\TipodocumentoidentificacionFormRequest;
use Illuminate\Http\Request;

class TipodocumentoidentificacionController extends Controller
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
            $tiposdocumentosidentificacion['Tiposdocumentosidentificacion'] = Tipodocumentoidentificacion::orderBy('id', 'DESC')
                    ->orwhere('abreviatura', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('tipodocumentoidentificacion.index', $tiposdocumentosidentificacion)->with('success','Busqueda realizada');
        }else{
            $tiposdocumentosidentificacion['Tiposdocumentosidentificacion'] = Tipodocumentoidentificacion::paginate(10);
            return view('tipodocumentoidentificacion.index', $tiposdocumentosidentificacion);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipodocumentoidentificacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipodocumentoidentificacionFormRequest $request)
    {
        $d = $request->except('_token');
        Tipodocumentoidentificacion::create($d);
        return redirect()->route('tipodocumentoidentificacion.index')->with('success','Tipo de documento de identificacion almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipodocumentoidentificacion  $tipodocumentoidentificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Tipodocumentoidentificacion $tipodocumentoidentificacion)
    {
        $auditoria = User::findOrFail($tipodocumentoidentificacion)->first();
        return view('tipodocumentoidentificacion.show', compact('tipodocumentoidentificacion', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipodocumentoidentificacion  $tipodocumentoidentificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipodocumentoidentificacion $tipodocumentoidentificacion)
    {
        return view('tipodocumentoidentificacion.edit', compact('tipodocumentoidentificacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipodocumentoidentificacion  $tipodocumentoidentificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipodocumentoidentificacion $tipodocumentoidentificacion)
    {
        $tipodocumentoidentificacion->update($request->all());
        return redirect()->route('tipodocumentoidentificacion.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipodocumentoidentificacion  $tipodocumentoidentificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipodocumentoidentificacion $tipodocumentoidentificacion)
    {
        $tipodocumentoidentificacion->delete();
        return redirect()->route('tipodocumentoidentificacion.index')->with('success','Registro borrado completamente');
    }
}
