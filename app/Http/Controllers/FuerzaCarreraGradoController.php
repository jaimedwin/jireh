<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Carrera;
use App\User;
use App\Http\Requests\GradoFormRequest;
use Illuminate\Http\Request;

class FuerzaCarreraGradoController extends Controller
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
    public function index($fuerza_id, $carrera_id, Request $request)
    {
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $grados = Grado::orderBy('id', 'ASC')->where('carrera_id', $carrera_id);
        
        if ($palabrasbuscar){
            $columnas = ['abreviatura','descripcion'];
            $Grados = $grados
                    ->where(function ($query) use ($columnas, $palabrasbuscar) {
                        foreach ($palabrasbuscar as $palabra) {
                            $query = $query->where(function ($query) use ($columnas,$palabra) {
                                foreach ($columnas as $columna) {
                                    $query->orWhere($columna,'like',"%$palabra%");
                                }
                            });
                        }
                    })->paginate(100);
                    
            return view('fuerza.carrera.grado.index', compact('fuerza_id' , 'carrera_id', 'Grados'))
            ->with('success','Busqueda realizada');
        }else{
            $Grados = $grados->paginate(10);
            return view('fuerza.carrera.grado.index', compact('fuerza_id' , 'carrera_id', 'Grados'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($fuerza_id, $carrera_id, GradoFormRequest $request)
    {
        $d = $request->except('_token');
        $grado = Grado::create($d);
        return redirect()->route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])
                ->with('success','Recordatorio del proceso almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function show($fuerza_id, $carrera_id, $id)
    {
        $grado = Grado::find($id);
        $auditoria = User::findOrFail($grado->users_id)->first();
        return view('fuerza.carrera.grado.show', compact('fuerza_id','carrera_id', 'auditoria', 'grado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function edit($fuerza_id, $carrera_id, $id)
    {
        $grado = Grado::find($id);
        return view('fuerza.carrera.grado.edit', compact('grado', 'fuerza_id', 'carrera_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function update($fuerza_id, $carrera_id, $id, GradoFormRequest $request)
    {
        $grado = Grado::find($id);
        $grado->update($request->except('_token'));
        return redirect()->route('fuerza.carrera.grado.index', [$carrera_id, $carrera_id])
                    ->with('success','Recordatorio del proceso actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grado  $grado
     * @return \Illuminate\Http\Response
     */
    public function destroy($fuerza_id, $carrera_id, $id)
    {
        $grado =  Grado::find($id);
        $grado->delete();
        return redirect()->route('fuerza.carrera.grado.index', [$carrera_id, $carrera_id])
        ->with('success','Registro borrado completamente');
    }
}