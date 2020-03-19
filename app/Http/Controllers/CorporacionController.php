<?php

namespace App\Http\Controllers;

use App\Corporacion;
use App\User;
use App\Http\Requests\CorporacionFormRequest;
use Illuminate\Http\Request;

class CorporacionController extends Controller
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
            $corporaciones['Corporaciones'] = Corporacion::orderBy('id', 'DESC')
                    ->orwhere('nombre', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('correonotificacion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('corporacion.index', $corporaciones)->with('success','Busqueda realizada');
        }else{
            $corporaciones['Corporaciones'] = Corporacion::paginate(10);
            return view('corporacion.index', $corporaciones);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('corporacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CorporacionFormRequest $request)
    {
        $d = $request->except('_token');
        Corporacion::create($d);
        return redirect()->route('corporacion.index')->with('success','Corporacion almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corporacion  $corporacion
     * @return \Illuminate\Http\Response
     */
    public function show(Corporacion $corporacion)
    {
        $auditoria = User::findOrFail($corporacion)->first();
        return view('corporacion.show', compact('corporacion', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corporacion  $corporacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Corporacion $corporacion)
    {
        return view('corporacion.edit', compact('corporacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corporacion  $corporacion
     * @return \Illuminate\Http\Response
     */
    public function update(CorporacionFormRequest $request, Corporacion $corporacion)
    {
        $corporacion->update($request->all());
        return redirect()->route('corporacion.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corporacion  $corporacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corporacion $corporacion)
    {
        $corporacion->delete();
        return redirect()->route('corporacion.index')->with('success','Registro borrado completamente');
    }
}
