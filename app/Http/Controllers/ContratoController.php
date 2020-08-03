<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Tipocontrato;
use App\Models\Personanatural;
use App\Models\Proceso;
use App\Models\Pago;
use App\User;
use App\Http\Requests\ContratoFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    const PATH = 'otrosdocumentos/';

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
        $contratos = Contrato::orderBy('id', 'ASC')
                        ->select('contrato.*', 'tipocontrato.descripcion AS tipocontrato',
                                    'personanatural.numerodocumento', 
                                    'proceso.numero AS proceso_numero',
                                    'proceso.codigo AS proceso_codigo')
                        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('tipocontrato','tipocontrato_id','=','tipocontrato.id')
                        ->join('personanatural','personanatural_id','=','personanatural.id')
                        ->join('proceso','proceso_id','=','proceso.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['contrato.valor', 'contrato.numero', 'tipocontrato.descripcion', 
                'personanatural.nombres', 'personanatural.apellidopaterno', 
                'personanatural.apellidomaterno', 'personanatural.numerodocumento', 
                'proceso.numero', 'proceso.codigo'];
            $Contratos['Contratos'] = $contratos
            ->whereOrSearch($palabrasbuscar, $columnas);
                    
            return view('contrato.index', $Contratos)
            ->with('success',['Busqueda realizada']);
        }else{
            $Contratos['Contratos'] = $contratos->paginate(10);
            return view('contrato.index', $Contratos);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Tipocontratos = Tipocontrato::select('id', 'descripcion')->get();
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
            ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
            ->get();
        $Procesos = Proceso::select('id', 'codigo', 'numero')->get();
        return view('contrato.create', compact('Tipocontratos', 'Personasnaturales', 'Procesos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoFormRequest $request)
    {
        $file = $request->file('nombrearchivo');
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        $contratos = Contrato::create($request->except('nombrearchivo')
            + ['nombrearchivo' => $fileName]);
        $path = $file->storeAs(self::PATH. $request->personanatural_id, $fileName);
        if (Storage::exists($path)){
            return redirect()->route('contrato.index')
                ->with('success',['Actuación del proceso almacenado completamente', 
                'Archivo de actuación del proceso almacenado completamente']);
        }else{
            return redirect()->route('contrato.index')
                ->with('success',['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        $auditoria = User::findOrFail($contrato->users_id);
        $tipocontrato = Tipocontrato::select('descripcion')->findOrFail($contrato->tipocontrato_id);
        $personanatural = Personanatural::select('nombres', 'apellidopaterno', 'apellidomaterno')->findOrFail($contrato->personanatural_id);
        $procesos = Proceso::select('id', 'numero')->get();
        return view('contrato.show', compact('tipocontrato', 'personanatural', 'contrato', 'auditoria', 'procesos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        $Tipocontratos = Tipocontrato::select('id', 'descripcion')->get();
        $Personasnaturales = Personanatural::select('id', 'numerodocumento')
            ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
            ->get();
        $Procesos = Proceso::select('id', 'codigo', 'numero')->get();
        return view('contrato.edit', compact('contrato', 'Tipocontratos', 'Personasnaturales', 'Procesos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoFormRequest $request, Contrato $contrato)
    {
        $file = $request->file('nombrearchivo');
        $nombrearchivo_anterior = $request->nombrearchivo_anterior;
        $personanatural_anterior = $request->personanatural_anterior;
        $fileName = date("dmY"). '-'. time().'.'.$file->getClientOriginalExtension();
        
        $contratos = $contrato->update($request->except('nombrearchivo', 'personanatural_anterior')
            + ['nombrearchivo' => $fileName]);
        
        $path = $file->storeAs(self::PATH. $request->personanatural_id, $fileName);
        $result = $this->deleteFile($personanatural_anterior, $nombrearchivo_anterior);
        if (Storage::exists($path)){
            return redirect()->route('contrato.index')
            ->with('success',['Contrato actualizado', 
            'Archivo previo borrado completamente: '. $nombrearchivo_anterior,
            'Se carga nuevo archivo: '. $fileName]);
        }else{
            return redirect()->route('contrato.edit')
            ->with('success',['Error no se escribio archivo en disco']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = Pago::where('contrato_id', '=', $id)->get();
        if ($valida->isEmpty()) {
            $contrato = Contrato::findOrFail($id);
            $result1 = $contrato->delete();
            $result2 = $this->deleteFile($contrato->personanatural_id, $contrato->nombrearchivo);
            if($result1 && $result2)
                return redirect()->route('contrato.index')->with('success',
                    ['Registro borrado completamente','Archivo borrado completamente'
                    ]);
        }
        
        return redirect()->route('contrato.index')
            ->withErrors(['No se puede borrar el contrato', 'El contrato tiene pagos asociados']);
        
    }

    public function downloadFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::download(self::PATH. $id.'/'.$name);
        }
        return redirect()->route('contrato.index')->withErrors(['No se encuentra el archivo: '. $name]);
    }

    public function deleteFile($id, $name)
    {
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::delete(self::PATH. '/'. $id.'/'.$name); 
        }
            
        return redirect()->route('contrato.index')->withErrors(['No se encuentra el archivo: '. $name]);
    }
}

