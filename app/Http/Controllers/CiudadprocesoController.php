<?php

namespace App\Http\Controllers;

use App\Models\Ciudadproceso;
use App\Models\Proceso;
use App\User;
use App\Http\Requests\CiudadprocesoFormRequest;
use Illuminate\Http\Request;

class CiudadprocesoController extends Controller
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
            $ciudadprocesos['Ciudadprocesos'] = Ciudadproceso::orderBy('id', 'DESC')
                    ->orwhere('nombre', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('ciudadproceso.index', $ciudadprocesos)->with('success','Busqueda realizada');
        }else{
            $ciudadprocesos['Ciudadprocesos'] = Ciudadproceso::paginate(10);
            return view('ciudadproceso.index', $ciudadprocesos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ciudadproceso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CiudadprocesoFormRequest $request)
    {
        $d = $request->except('_token');
        Ciudadproceso::create($d);
        return redirect()->route('ciudadproceso.index')->with('success','Ciudad del proceso almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciudadproceso  $ciudadproceso
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudadproceso $ciudadproceso)
    {
        $auditoria = User::findOrFail($ciudadproceso)->first();
        return view('ciudadproceso.show', compact('ciudadproceso', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciudadproceso  $ciudadproceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudadproceso $ciudadproceso)
    {
        return view('ciudadproceso.edit', compact('ciudadproceso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudadproceso  $ciudadproceso
     * @return \Illuminate\Http\Response
     */
    public function update(CiudadprocesoFormRequest $request, Ciudadproceso $ciudadproceso)
    {
        $ciudadproceso->update($request->all());
        return redirect()->route('ciudadproceso.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudadproceso  $ciudadproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudadproceso $ciudadproceso)
    {
        $valida = Proceso::where('ciudadproceso_id', '=', $ciudadproceso->id)->get();
        if ($valida->isEmpty()) {
            $ciudadproceso->delete();
            return redirect()->route('ciudadproceso.index')->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('ciudadproceso.index')
            ->withErrors(['No se puede borrar la ciudad', 'La ciudad tiene proceso(s) asociado(s)']);
        }
    }
}
