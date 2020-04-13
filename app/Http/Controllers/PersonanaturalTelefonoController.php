<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use App\User;
use App\Http\Requests\TelefonoFormRequest;
use Illuminate\Http\Request;

class PersonanaturalTelefonoController extends Controller
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
        $telefonos = Telefono::orderBy('telefono.id', 'ASC')
                                ->select('telefono.*')
                                ->where('personanatural_id','=',$personanatural_id);  
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['prefijo', 'numero'];
            $Telefonos = $telefonos
            ->whereOrSearch($palabrasbuscar, $columnas);
            return view('personanatural.telefono.index', compact('Telefonos', 'personanatural_id'))->with('success','Busqueda realizada');
        }else{
            $Telefonos = $telefonos->paginate(10);
            return view('personanatural.telefono.index', compact('Telefonos', 'personanatural_id'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($personanatural_id, TelefonoFormRequest $request)
    {
        if($request->principal == 1){
            $telefono = Telefono::orderBy('telefono.id', 'ASC')
                                ->select('telefono.id')
                                ->where('personanatural_id','=',$personanatural_id)
                                ->where('principal','=',1)->get();
            if ($telefono->isEmpty()){
                $telefono = Telefono::create($request->except('_token'));
                return redirect()->route('personanatural.telefono.index', $personanatural_id)
                    ->with('success','Telefono almacenado completamente');
            }else{
                return redirect()->route('personanatural.telefono.index', $personanatural_id)
                    ->withErrors(['No se registro el telefono', 'Ya existe un telefono principal']);
            }
        }else{
            $telefono = Telefono::create($request->except('_token'));
            return redirect()->route('personanatural.telefono.index', $personanatural_id)
                    ->with('success','Telefono almacenado completamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function show($personanatural_id, $id)
    {
        $telefono = Telefono::find($id);
        $auditoria = User::findOrFail($telefono->users_id)->first();
        return view('personanatural.telefono.show', compact('personanatural_id', 'auditoria', 'telefono'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function edit($personanatural_id, $id)
    {
        $telefono = Telefono::find($id);
        return view('personanatural.telefono.edit', compact('telefono', 'personanatural_id', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function update($personanatural_id, $id, TelefonoFormRequest $request)
    {
        $telefono = Telefono::find($id);
        $telefono->update($request->except('_token'));
        return redirect()->route('personanatural.telefono.index', $personanatural_id)
                    ->with('success','Telefono actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Telefono  $telefono
     * @return \Illuminate\Http\Response
     */
    public function destroy($personanatural_id, $id)
    {
        $telefono =  Telefono::find($id);
        $telefono->delete();
        return redirect()->route('personanatural.telefono.index', $personanatural_id)->with('success','Registro borrado completamente');
    }
}
