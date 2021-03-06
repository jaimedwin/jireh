<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Proceso;
use App\User;
use App\Http\Requests\EstadoFormRequest;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
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
            $estados['Estados'] = Estado::orderBy('id', 'DESC')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('estado.index', $estados)->with('success',['Busqueda realizada']);
        }else{
            $estados['Estados'] = Estado::paginate(10);
            return view('estado.index', $estados);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoFormRequest $request)
    {
        $d = $request->except('_token');
        Estado::create($d);
        return redirect()->route('estado.index')->with('success',['Estado almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        $auditoria = User::findOrFail($estado->users_id);
        return view('estado.show', compact('estado', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {   
        return view('estado.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoFormRequest $request, Estado $estado)
    {
        $estado->update($request->all());
        return redirect()->route('estado.index')->with('success',['Estado actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Proceso::where('estado_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $estado = Estado::findOrFail($id);
            if($estado->delete())
                return redirect()->route('estado.index')->with('success',['Estado borrado completamente']);
        }
        return redirect()->route('estado.index')
            ->withErrors(['No se puede borrar el estado', 'El estado tiene proceso(s) asociado(s)']);
    }
}
