<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Carrera;
use App\Models\Personanatural;
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
        $grados = Grado::orderBy('id', 'ASC')
            ->join('carrera', 'grado.carrera_id', '=', 'carrera.id')
            ->join('fuerza', 'carrera.fuerza_id', '=', 'fuerza.id')
            ->select('grado.*', 'carrera.id as carreraid', 'carrera.fuerza_id AS carrerafuerzaid', 'fuerza.id AS fuerzaid')
            ->where('carrera.id', '=', $carrera_id)
            ->where('fuerza.id', '=', $fuerza_id);
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){    
            $columnas = ['grado.abreviatura','grado.descripcion'];
            $Grados = $grados->whereOrSearch($palabrasbuscar, $columnas);
            return view('fuerza.carrera.grado.index', compact('fuerza_id' , 'carrera_id', 'Grados'))
            ->with('success','Busqueda realizada');
        }else{
            $Grados = $grados->paginate(10);
            return view('fuerza.carrera.grado.index', compact('fuerza_id' , 'carrera_id', 'Grados'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fuerza_id, $carrera_id)
    {
        return view('fuerza.carrera.grado.create', compact('fuerza_id', 'carrera_id'));
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
        $valida = Personanatural::where('grado_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $grado =  Grado::find($id);
            $grado->delete();
            return redirect()->route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])
            ->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('fuerza.carrera.grado.index', [$fuerza_id, $carrera_id])
             ->withErrors(['No se puede borrar el grado', 
             'El grado tiene persona(s) naturales(s) asociada(s)']);
          }
    }
}
