<?php

namespace App\Http\Controllers;

use App\Models\Fuerza;
use App\Models\Carrera;
use App\User;
use App\Http\Requests\FuerzaFormRequest;
use Illuminate\Http\Request;

class FuerzaController extends Controller
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
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $fuerzas = Fuerza::orderBy('id', 'DESC');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){    
            $columnas = ['abreviatura','descripcion'];
            $Fuerzas['Fuerzas'] = $fuerzas->whereOrSearch($palabrasbuscar, $columnas);
            return view('fuerza.index', $Fuerzas)->with('success','Busqueda realizada');
        }else{
            $Fuerzas['Fuerzas'] = $fuerzas->paginate(10);
            
            return view('fuerza.index', $Fuerzas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fuerza.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuerzaFormRequest $request)
    {
        Fuerza::create($request->except('_token'));
        return redirect()->route('fuerza.index')->with('success','Fuerza almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fuerza  $fuerza
     * @return \Illuminate\Http\Response
     */
    public function show(Fuerza $fuerza)
    {
        $auditoria = User::findOrFail($fuerza)->first();
        return view('fuerza.show', compact('fuerza', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuerza  $fuerza
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuerza $fuerza)
    {
        return view('fuerza.edit', compact('fuerza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fuerza  $fuerza
     * @return \Illuminate\Http\Response
     */
    public function update(FuerzaFormRequest $request, Fuerza $fuerza)
    {
        $fuerza->update($request->all());
        return redirect()->route('fuerza.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fuerza  $fuerza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuerza $fuerza)
    {
        $valida = Carrera::where('fuerza_id', '=', $fuerza->id)->get();
        if ($valida->isEmpty()) {
            $fuerza->delete();
            return redirect()->route('fuerza.index')->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('fuerza.index')
             ->withErrors(['No se puede borrar el registro de la fuerza', 
             'Laa fuerza tiene carrera(s) asociada(s)']);
        }
    }
}
