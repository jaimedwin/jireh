<?php

namespace App\Http\Controllers;

use App\Models\Eps;
use App\Models\Personanatural;
use App\User;
use App\Http\Requests\EpsFormRequest;
use Illuminate\Http\Request;

class EpsController extends Controller
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
            $epss['epss'] = Eps::orderBy('id', 'DESC')
                    ->orwhere('abreviatura', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('eps.index', $epss)->with('success',['Busqueda realizada']);
        }else{
            $epss['epss'] = Eps::paginate(10);
            return view('eps.index', $epss);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpsFormRequest $request)
    {
        $d = $request->except('_token');
        Eps::create($d);
        return redirect()->route('eps.index')->with('success',['Eps almacenada completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Eps  $eps
     * @return \Illuminate\Http\Response
     */
    public function show(Eps $ep)
    {
        $auditoria = User::findOrFail($ep->users_id);
        return view('eps.show', compact('ep', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Eps  $eps
     * @return \Illuminate\Http\Response
     */
    public function edit(Eps $ep)
    {
        return view('eps.edit', compact('ep'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Eps  $eps
     * @return \Illuminate\Http\Response
     */
    public function update(EpsFormRequest $request, Eps $ep)
    {
        $ep->update($request->all());
        return redirect()->route('eps.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Eps  $eps
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Personanatural::where('eps_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $eps = Eps::findOrFail($id);
            if($eps->delete())
                return redirect()->route('eps.index')->with('success',['Registro borrado completamente']);
        }
        return redirect()->route('eps.index')
            ->withErrors(['No se puede borrar la eps', 
            'La eps tiene persona(s) naturales(s) asociada(s)']);
        
    }
}
