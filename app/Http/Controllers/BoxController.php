<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Clienteproceso;
use App\User;
use App\Http\Requests\BoxFormRequest;
use Illuminate\Http\Request;

class BoxController extends Controller
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
        $boxs = Box::select('box.*')->orderBy('created_at', 'DESC');

        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['box.abreviatura', 'box.descripcion'];
            $Boxs['Boxs'] = $boxs->whereOrSearch($palabrasbuscar, $columnas);
            return view('box.index', $Boxs)->with('success',['Busqueda realizada']);
        }else{
            $Boxs['Boxs'] = $boxs->paginate(10);
            return view('box.index', $Boxs);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('box.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoxFormRequest $request)
    {
        $d = $request->except('_token');
        Box::create($d);
        return redirect()->route('box.index')->with('success',['Box almacenada completamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        $auditoria = User::findOrFail($box->users_id);
        return view('box.show', compact('box', 'auditoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit(Box $box)
    {
        return view('box.edit', compact('box'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(BoxFormRequest $request, Box $box)
    {
        $box->update($request->all());
        return redirect()->route('box.index')->with('success',['Registro actualizado completamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Clienteproceso::where('box_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $box = Box::findOrFail($id);
            if($box->delete())
                return redirect()->route('box.index')->with('success',['Registro borrado completamente']);
        }
        return redirect()->route('box.index')
            ->withErrors(['No se puede borrar la box', 
            'La box tiene registro(s) asociada(s) en Persona naturales y proceso']);
    }
}
