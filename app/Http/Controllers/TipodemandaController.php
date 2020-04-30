<?php

namespace App\Http\Controllers;

use App\Models\Tipodemanda;
use App\Models\Clienteproceso;
use App\User;
use App\Http\Requests\TipodemandaFormRequest;
use Illuminate\Http\Request;

class TipodemandaController extends Controller
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
            $tipodemandas['Tipodemandas'] = Tipodemanda::orderBy('id', 'DESC')
                    ->orwhere('abreviatura', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('comentario', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('tipodemanda.index', $tipodemandas)->with('success',['Busqueda realizada']);
        }else{
            $tipodemandas['Tipodemandas'] = Tipodemanda::paginate(10);
            return view('tipodemanda.index', $tipodemandas);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipodemanda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipodemandaFormRequest $request)
    {
        $d = $request->except('_token');
        Tipodemanda::create($d);
        return redirect()->route('tipodemanda.index')->with('success',['Tipo de demanda almacenado completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipodemanda  $tipodemanda
     * @return \Illuminate\Http\Response
     */
    public function show(Tipodemanda $tipodemanda)
    {
        $auditoria = User::findOrFail($tipodemanda->users_id);
        return view('tipodemanda.show', compact('tipodemanda', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipodemanda  $tipodemanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipodemanda $tipodemanda)
    {
        return view('tipodemanda.edit', compact('tipodemanda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipodemanda  $tipodemanda
     * @return \Illuminate\Http\Response
     */
    public function update(TipodemandaFormRequest $request, Tipodemanda $tipodemanda)
    {
        $tipodemanda->update($request->all());
        return redirect()->route('tipodemanda.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipodemanda  $tipodemanda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Clienteproceso::where('tipodemanda_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $tipodemanda = Tipodemanda::findOrFail($id);
            if($tipodemanda->delete())
                return redirect()->route('tipodemanda.index')->with('success',['Registro borrado completamente']);
        }
        return redirect()->route('tipodemanda.index')
            ->withErrors(['No se puede borrar el tipo de demanda', 'El tipo de demanda tiene cliente(s) y proceso(s) asociado(s)']);
        
    }
}
