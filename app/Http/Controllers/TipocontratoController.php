<?php

namespace App\Http\Controllers;

use App\Models\Tipocontrato;
use App\Models\Contrato;
use App\User;
use App\Http\Requests\TipocontratoFormRequest;
use Illuminate\Http\Request;

class TipocontratoController extends Controller
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
            $tipocontratos['Tipocontratos'] = Tipocontrato::orderBy('id', 'DESC')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('tipocontrato.index', $tipocontratos)->with('success','Busqueda realizada');
        }else{
            $tipocontratos['Tipocontratos'] = Tipocontrato::paginate(10);
            return view('tipocontrato.index', $tipocontratos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipocontrato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipocontratoFormRequest $request)
    {
        $d = $request->except('_token');
        Tipocontrato::create($d);
        return redirect()->route('tipocontrato.index')->with('success','Tipo de contrato almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function show(Tipocontrato $tipocontrato)
    {
        $auditoria = User::findOrFail($tipocontrato)->first();
        return view('tipocontrato.show', compact('tipocontrato', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipocontrato $tipocontrato)
    {
        return view('tipocontrato.edit', compact('tipocontrato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipocontrato $tipocontrato)
    {
        $tipocontrato->update($request->all());
        return redirect()->route('tipocontrato.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipocontrato  $tipocontrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipocontrato $tipocontrato)
    {
        $valida = Contrato::where('tipocontrato_id', '=', $tipocontrato->id)->get();
        if ($valida->isEmpty()) {
            $tipocontrato->delete();
            return redirect()->route('tipocontrato.index')->with('success','Registro borrado completamente');
        }else{
            return redirect()->route('tipocontrato.index')
             ->withErrors(['No se puede borrar el tipo de contrato', 
             'El tipo de contrato tiene contrato(s) asociado(s)']);
          }
    }
}
