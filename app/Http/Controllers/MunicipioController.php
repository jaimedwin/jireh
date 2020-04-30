<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Departamento;
use App\Models\Personanatural;
use App\User;
use App\Http\Requests\MunicipioFormRequest;
use Illuminate\Http\Request;

class MunicipioController extends Controller
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
        $municipios = Municipio::orderBy('id', 'DESC')
                        ->select('municipio.*', 'departamento.nombre AS departamento')
                        ->join('departamento', 'departamento_id', '=', 'departamento.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['municipio.nombre','departamento.nombre'];
            $Municipios['Municipios'] = $municipios->whereOrSearch($palabrasbuscar, $columnas);
            return view('municipio.index', $Municipios)->with('success',['Busqueda realizada']);
        }else{
            $Municipios['Municipios'] = $municipios->paginate(10);
            return view('municipio.index', $Municipios);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Departamentos = Departamento::select('id', 'nombre')->orderBy('nombre', 'ASC')->get();
        return view('municipio.create', compact('Departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioFormRequest $request)
    {
        $d = $request->except('_token');
        Municipio::create($d);
        return redirect()->route('municipio.index')->with('success',['Municipio almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function show(Municipio $municipio)
    {
        $auditoria = User::findOrFail($municipio->users_id);
        $departamento = Departamento::findOrFail($municipio->departamento_id);
        return view('municipio.show', compact('municipio', 'auditoria', 'departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipio $municipio)
    {
        $Departamentos = Departamento::select('id', 'nombre')->orderBy('nombre', 'ASC')->get();
        return view('municipio.edit', compact('municipio', 'Departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipioFormRequest $request, Municipio $municipio)
    {
        $municipio->update($request->all());
        return redirect()->route('municipio.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Municipio $municipio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Personanatural::where('municipio_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $municipio = Municipio::findOrFail($id);
            if ($municipio->delete())
                return redirect()->route('municipio.index')->with('success',['Registro borrado completamente']);
        }
        return redirect()->route('municipio.index')
            ->withErrors(['No se puede borrar el municipio', 
            'El municipio tiene persona(s) naturales(s) asociada(s)']);
    }
}
