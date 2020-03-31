<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use App\Models\User;
use App\Http\Requests\PonenteFormRequest;
use Illuminate\Http\Request;

class PonenteController extends Controller
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
            $ponentes['Ponentes'] = Ponente::orderBy('id', 'DESC')
                    ->orwhere('nombrecompleto', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('ponente.index', $ponentes)->with('success','Busqueda realizada');
        }else{
            $ponentes['Ponentes'] = Ponente::paginate(10);
            return view('ponente.index', $ponentes);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PonenteFormRequest $request)
    {
        $d = $request->except('_token');
        Ponente::create($d);
        return redirect()->route('ponente.index')->with('success','Ponente almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function show(Ponente $ponente)
    {
        $auditoria = User::findOrFail($ponente)->first();
        return view('ponente.show', compact('ponente', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function edit(Ponente $ponente)
    {
        return view('ponente.edit', compact('ponente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ponente $ponente)
    {
        $ponente->update($request->all());
        return redirect()->route('ponente.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponente  $ponente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ponente $ponente)
    {
        $ponente->delete();
        return redirect()->route('ponente.index')->with('success','Registro borrado completamente');
    }
}
