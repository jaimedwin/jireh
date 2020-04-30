<?php

namespace App\Http\Controllers;

use App\Models\Correo;
use App\User;
use App\Http\Requests\CorreoFormRequest;
use Illuminate\Http\Request;

class PersonanaturalCorreoController extends Controller
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
    public function index($personanatural_id, Request $request)
    {
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $correos = Correo::orderBy('correo.id', 'ASC')
                                ->select('correo.*')
                                ->where('personanatural_id','=',$personanatural_id);  
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['prefijo', 'numero'];
            $Correos = $correos
            ->whereOrSearch($palabrasbuscar, $columnas);
            return view('personanatural.correo.index', compact('Correos', 'personanatural_id'))->with('success',['Busqueda realizada']);
        }else{
            $Correos = $correos->paginate(10);
            return view('personanatural.correo.index', compact('Correos', 'personanatural_id'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($personanatural_id)
    {
        return view('personanatural.correo.create', compact('personanatural_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($personanatural_id, CorreoFormRequest $request)
    {
        if($request->principal == 1){
            $correo = Correo::orderBy('correo.id', 'ASC')
                                ->select('correo.id')
                                ->where('personanatural_id','=',$personanatural_id)
                                ->where('principal','=',1)->get();
            if ($correo->isEmpty()){
                $correo = Correo::create($request->except('_token'));
                return redirect()->route('personanatural.correo.index', $personanatural_id)
                    ->with('success',['Correo almacenado completamente']);
            }else{
                return redirect()->back()->withErrors(['No se registro el correo', 'Ya existe un correo principal']);
            }
        }else{
            $correo = Correo::create($request->except('_token'));
            return redirect()->route('personanatural.correo.index', $personanatural_id)
                    ->with('success',['Correo almacenado completamente']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function show($personanatural_id, $id)
    {
        $correo = Correo::findOrFail($id);
        $auditoria = User::findOrFail($correo->users_id);
        return view('personanatural.correo.show', compact('personanatural_id', 'auditoria', 'correo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function edit($personanatural_id, $id)
    {
        $correo = Correo::findOrFail($id);
        return view('personanatural.correo.edit', compact('correo', 'personanatural_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function update($personanatural_id, $id, CorreoFormRequest $request)
    {
        $correo = Correo::findOrFail($id);
        $correo->update($request->except('_token'));
        return redirect()->route('personanatural.correo.index', $personanatural_id)
                    ->with('success',['Correo actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Correo  $correo
     * @return \Illuminate\Http\Response
     */
    public function destroy($personanatural_id, $id)
    {
        $correo =  Correo::findOrFail($id);
        if($correo->delete())
            return redirect()->route('personanatural.correo.index', $personanatural_id)->with('success',['Registro borrado completamente']);
        return redirect()->route('personanatural.correo.index', $personanatural_id)->withErrors(['No se pudo borrar el registro']);
    }
}
