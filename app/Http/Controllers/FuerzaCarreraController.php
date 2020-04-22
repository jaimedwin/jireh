<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Fuerza;
use App\Models\Grado;
use App\User;
use App\Http\Requests\CarreraFormRequest;
use Illuminate\Http\Request;

class FuerzaCarreraController extends Controller
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
    public function index($fuerza_id, Request $request)
    {
        $palabrasbuscar = explode(" ",$request->post('buscar'));

        
        $carreras = Carrera::orderBy('id', 'ASC')->where('fuerza_id', $fuerza_id);
        
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){    
            $columnas = ['abreviatura','descripcion'];
            $Carreras = $carreras->whereOrSearch($palabrasbuscar, $columnas);
                    
            return view('fuerza.carrera.index', compact('fuerza_id' , 'Carreras'))->with('success','Busqueda realizada');
        }else{
            $Carreras = $carreras->paginate(10);
            return view('fuerza.carrera.index', compact('fuerza_id' , 'Carreras'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fuerza_id)
    {
        return view('fuerza.carrera.create', compact('fuerza_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($fuerza_id, CarreraFormRequest $request)
    {
        $d = $request->except('_token');
        
        $carrera = Carrera::create($d);
        return redirect()->route('fuerza.carrera.index', $fuerza_id)
                ->with('success','Fuerza almacenada completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show($fuerza_id, $id)
    {
        $carrera = Carrera::find($id);
        $auditoria = User::findOrFail($carrera->users_id)->first();
        return view('fuerza.carrera.show', compact('fuerza_id', 'auditoria', 'carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function edit($fuerza_id, $id)
    {
        $carrera = Carrera::find($id);
        return view('fuerza.carrera.edit', compact('carrera', 'fuerza_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update($fuerza_id, $id, CarreraFormRequest $request)
    {
        $carrera = Carrera::find($id);
        $carrera->update($request->except('_token'));
        return redirect()->route('fuerza.carrera.index', $fuerza_id)
                    ->with('success','Recordatorio del proceso actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy($fuerza_id, $id)
    {
        $valida = Grado::where('carrera_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $carrera =  Carrera::find($id);
            $carrera->delete();
            return redirect()->route('fuerza.carrera.index', $fuerza_id)->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('fuerza.carrera.index', $fuerza_id)
             ->withErrors(['No se puede borrar la carrera', 
             'La carrera tiene grado(s) asociado(s)']);
        }
    }
}
