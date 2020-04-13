<?php

namespace App\Http\Controllers;

use App\Models\Personajuridica;
use App\Models\Personanatural;
use App\User;
use App\Http\Requests\PersonajuridicaFormRequest;
use Illuminate\Http\Request;

class PersonajuridicaController extends Controller
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
        print(implode(" ",$palabrasbuscar));
        $personasjuridicas = Personajuridica::orderBy('id', 'ASC')
                        ->select('personajuridica.*')
                        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('personanatural','personanatural_id','=','personanatural.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['tipodocumento.abreviatura', 
            'personanatural.nombres', 'personanatural.apellidopaterno', 'personanatural.apellidomaterno'];
            $Personasjuridicas['Personasjuridicas'] = $personasjuridicas->whereOrSearch($palabrasbuscar, $columnas);
            return view('personajuridica.index', $Personasjuridicas)
            ->with('success','Busqueda realizada');
        }else{
            $Personasjuridicas['Personasjuridicas'] = $personasjuridicas->paginate(10);
            return view('personajuridica.index', $Personasjuridicas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        return view('personajuridica.create', compact('Personasnaturales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonajuridicaFormRequest $request)
    {
        $personasjuridica = Personajuridica::create($request->except('_token'));
        return redirect()->route('personajuridica.index')
                ->with('success',['Registro de la personajuridica almacenada completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function show(Personajuridica $personajuridica)
    {
        $auditoria = User::findOrFail($personajuridica)->first();
        $personanatural = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->find($personajuridica->personanatural_id);
        return view('personajuridica.show', compact('personajuridica', 'auditoria', 'personanatural'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function edit(Personajuridica $personajuridica)
    {
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        return view('personajuridica.edit', compact('personajuridica', 'Personasnaturales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function update(PersonajuridicaFormRequest $request, Personajuridica $personajuridica)
    {
        $personajuridica->update($request->all());
        return redirect()->route('personajuridica.index')->with('success',['Registro actualizado completamente']);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personajuridica  $personajuridica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personajuridica $personajuridica)
    {
        $personajuridica->delete();
        return redirect()->route('personajuridica.index')->with('success',['Registro borrado completamente']);
    }
}
