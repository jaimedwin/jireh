<?php

namespace App\Http\Controllers;

use App\Models\Expedicion;
use App\Models\Personanatural;
use App\User;
use App\Http\Requests\ExpedicionFormRequest;
use Illuminate\Http\Request;

class ExpedicionController extends Controller
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
            $expediciones['Expediciones'] = Expedicion::orderBy('id', 'DESC')
                    ->orwhere('lugar', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('expedicion.index', $expediciones)->with('success','Busqueda realizada');
        }else{
            $expediciones['Expediciones'] = Expedicion::paginate(10);
            return view('expedicion.index', $expediciones);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expedicion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedicionFormRequest $request)
    {
        $d = $request->except('_token');
        Expedicion::create($d);
        return redirect()->route('expedicion.index')->with('success','Expedición almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function show(Expedicion $expedicion)
    {
        $auditoria = User::findOrFail($expedicion)->first();
        return view('expedicion.show', compact('expedicion', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function edit(Expedicion $expedicion)
    {
        return view('expedicion.edit', compact('expedicion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expedicion $expedicion)
    {
        $expedicion->update($request->all());
        return redirect()->route('expedicion.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expedicion  $expedicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expedicion $expedicion)
    {
        $valida = Personanatural::where('expedicion_id', '=', $expedicion->id)->get();
        if ($valida->isEmpty()) {
            $expedicion->delete();
            return redirect()->route('expedicion.index')->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('expedicion.index')
             ->withErrors(['No se puede borrar el lugar de expedición', 
             'El lugar de expedición tiene persona(s) naturales(s) asociada(s)']);
        }
    }
}
