<?php

namespace App\Http\Controllers;

use App\Models\Fondodepension;
use App\User;
use App\Http\Requests\FondodepensionFormRequest;
use Illuminate\Http\Request;

class FondodepensionController extends Controller
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
            $fondodepensiones['Fondodepensiones'] = Fondodepension::orderBy('id', 'DESC')
                    ->orwhere('abreviatura', 'LIKE', '%'. $buscar. '%')
                    ->orwhere('descripcion', 'LIKE', '%'. $buscar. '%')
                    ->paginate(100);
            return view('fondodepension.index', $fondodepensiones)->with('success','Busqueda realizada');
        }else{
            $fondodepensiones['Fondodepensiones'] = Fondodepension::paginate(10);
            return view('fondodepension.index', $fondodepensiones);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fondodepension.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FondodepensionFormRequest $request)
    {
        $d = $request->except('_token');
        Fondodepension::create($d);
        return redirect()->route('fondodepension.index')->with('success','Fondo de pensión almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fondodepension  $fondodepension
     * @return \Illuminate\Http\Response
     */
    public function show(Fondodepension $fondodepension)
    {
        $auditoria = User::findOrFail($fondodepension)->first();
        return view('fondodepension.show', compact('fondodepension', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fondodepension  $fondodepension
     * @return \Illuminate\Http\Response
     */
    public function edit(Fondodepension $fondodepension)
    {
        return view('fondodepension.edit', compact('fondodepension'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fondodepension  $fondodepension
     * @return \Illuminate\Http\Response
     */
    public function update(FondodepensionFormRequest $request, Fondodepension $fondodepension)
    {
        $fondodepension->update($request->all());
        return redirect()->route('fondodepension.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fondodepension  $fondodepension
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fondodepension $fondodepension)
    {
        $fondodepension->delete();
        return redirect()->route('fondodepension.index')->with('success','Registro borrado completamente');
    }
}
