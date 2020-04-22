<?php

namespace App\Http\Controllers;

use App\Models\Clienteproceso;
use App\Models\Personanatural;
use App\Models\Proceso;
use App\Models\Tipodemanda;
use App\User;
use App\Http\Requests\ClienteprocesoFormRequest;
use Illuminate\Http\Request;

class ClienteprocesoController extends Controller
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
        $clientesprocesos = Clienteproceso::orderBy('id', 'ASC')
                        ->select('clienteproceso.*', 'proceso.numero AS proceso', 'tipodemanda.abreviatura AS tipodemanda')
                        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('proceso','proceso_id','=','proceso.id')
                        ->join('personanatural','personanatural_id','=','personanatural.id')
                        ->join('tipodemanda','tipodemanda_id','=','tipodemanda.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['proceso.numero', 'tipodemanda.abreviatura', 
            'personanatural.nombres', 'personanatural.apellidopaterno', 'personanatural.apellidomaterno'];
            $Clientesprocesos['Clientesprocesos'] = $clientesprocesos->whereOrSearch($palabrasbuscar, $columnas);
            return view('clienteproceso.index', $Clientesprocesos)
            ->with('success','Busqueda realizada');
        }else{
            $Clientesprocesos['Clientesprocesos'] = $clientesprocesos->paginate(10);
            return view('clienteproceso.index', $Clientesprocesos);
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
        $Procesos = Proceso::select('id', 'numero')->get();
        $Tiposdemandas = Tipodemanda::select('id', 'abreviatura', 'descripcion')->get();
        return view('clienteproceso.create', compact('Personasnaturales', 'Procesos', 'Tiposdemandas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteprocesoFormRequest $request)
    {
        $clienteoricesi = Clienteproceso::create($request->except('_token'));
        return redirect()->route('clienteproceso.index')
                ->with('success',['Registro del proceso almacenada completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function show(Clienteproceso $clienteproceso)
    {
        $auditoria = User::findOrFail($clienteproceso)->first();
        $personanatural = Personanatural::select('id', 'numerodocumento', 'codigo')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->findOrFail($clienteproceso->personanatural_id);
        $proceso = Proceso::select('id', 'numero', 'codigo')->findOrFail($clienteproceso->proceso_id);
        $tipodemanda = Tipodemanda::select('id', 'abreviatura', 'descripcion')->findOrFail($clienteproceso->tipodemanda_id);
        return view('clienteproceso.show', compact('clienteproceso', 'auditoria', 'personanatural', 'proceso', 'tipodemanda'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Clienteproceso $clienteproceso)
    {
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
        ->get();
        $Procesos = Proceso::select('id', 'numero')->get();
        $Tiposdemandas = Tipodemanda::select('id', 'abreviatura', 'descripcion')->get();
        return view('clienteproceso.edit', compact('clienteproceso', 'Personasnaturales', 'Procesos', 'Tiposdemandas'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteprocesoFormRequest $request, Clienteproceso $clienteproceso)
    {
        $clienteproceso->update($request->all());
        return redirect()->route('clienteproceso.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clienteproceso  $clienteproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clienteproceso $clienteproceso)
    {
        $clienteproceso->delete();
        return redirect()->route('clienteproceso.index')->with('success',['Registro borrado completamente']);
    }
}
