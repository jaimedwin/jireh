<?php

namespace App\Http\Controllers;
//namespace App\Http\Class;

use App\Models\Personanatural;
use App\Models\Tipodocumentoidentificacion;
use App\Models\Fondodepension;
Use App\Models\Expedicion;
use App\Models\Eps;
use App\Models\Grado;
use App\Models\Correo;
use App\Models\Telefono;
use App\Models\Documento;
use App\Models\Clienteproceso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonanaturalFormRequest;

class PersonanaturalController extends Controller 
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
        $Personasnaturales = Personanatural::orderBy('personanatural.id', 'ASC')
                                ->select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'expedicion.lugar AS expedicion',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('expedicion','expedicion_id','=','expedicion.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id');  
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){         
            $columnas = ['codigo', 'nombres', 'apellidopaterno', 'apellidomaterno', 
            'numerodocumento', 'direccion', 'eps', 'grado', 'expedicion'];
            $personasnaturales['Personasnaturales'] = $Personasnaturales
            ->whereOrSearch($palabrasbuscar, $columnas);
            return view('personanatural.index',  $personasnaturales)->with('success','Busqueda realizada');
        }else{
            $personasnaturales['Personasnaturales'] = $Personasnaturales->paginate(10);
            return view('personanatural.index', $personasnaturales);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Tiposdocumentosidentificacion = Tipodocumentoidentificacion::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Fondodepensiones = Fondodepension::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Expediciones = Expedicion::
            select('id', 'lugar')->orderBy('lugar', 'ASC')->get();
        $Eps = Eps::select('id', 'abreviatura')->orderBy('abreviatura', 'ASC')->get();
        $Grados = Grado::select('grado.id', 'grado.abreviatura', 'grado.descripcion', 'fuerza.abreviatura AS fuerza')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->orderBy('fuerza.abreviatura', 'ASC')
                        ->get();
        return view('personanatural.create', compact('Tiposdocumentosidentificacion', 'Fondodepensiones', 'Expediciones', 'Eps', 'Grados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonanaturalFormRequest $request)
    {
        $d = $request->except('_token');
        $personanatural = Personanatural::create($d);
        return redirect()->route('personanatural.index')
                ->with('success','Recordatorio del proceso almacenado completamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function show(Personanatural $personanatural)
    {

        $auditoria = User::findOrFail($personanatural)->first();
        $id = $personanatural->id;
        $personanatural = Personanatural::select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'expedicion.lugar AS expedicion',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('expedicion','expedicion_id','=','expedicion.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                                ->findOrFail($id);  
        return view('personanatural.show', compact('auditoria', 'personanatural'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function edit(Personanatural $personanatural)
    {
        $Tiposdocumentosidentificacion = Tipodocumentoidentificacion::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Fondodepensiones = Fondodepension::
            select('id', 'abreviatura', 'descripcion')->orderBy('abreviatura', 'ASC')->get();
        $Expediciones = Expedicion::
            select('id', 'lugar')->orderBy('lugar', 'ASC')->get();
        $Eps = Eps::select('id', 'abreviatura')->orderBy('abreviatura', 'ASC')->get();
        $Grados = Grado::select('grado.id', 'grado.abreviatura', 'grado.descripcion', 'fuerza.abreviatura AS fuerza')
                        ->join('carrera','carrera.id','=','carrera_id')
                        ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')
                        ->orderBy('fuerza.abreviatura', 'ASC')
                        ->get();
        return view('personanatural.edit', compact('personanatural', 'Tiposdocumentosidentificacion', 'Fondodepensiones', 'Expediciones', 'Eps', 'Grados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function update(PersonanaturalFormRequest $request, Personanatural $personanatural)
    {
        
        $personanatural->update($request->all());
        return redirect()->route('personanatural.index')->with('success','Registro actualizado completamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personanatural $personanatural)
    {
        $valida1 = Correo::where('personanatural_id', '=', $personanatural->id)->get();
        $valida2 = Telefono::where('personanatural_id', '=', $personanatural->id)->get();
        $valida3 = Documento::where('personanatural_id', '=', $personanatural->id)->get();
        $valida4 = Clienteproceso::where('personanatural_id', '=', $personanatural->id)->get();
        if ($valida1->isEmpty() && $valida2->isEmpty() && $valida3->isEmpty()) {
            $personanatural->delete();
            return redirect()->route('personanatural.index')->with('success','Registro borrado completamente');
        }else {
            $errors = array('No se puede borrar la persona natural');
            if (!$valida1->isEmpty()){
                array_push($errors, 'El proceso tiene correo(s) eletronico(s) asociado(s)');
            }
            if (!$valida2->isEmpty()){
                array_push($errors,'El proceso tiene telefo(s) asociado(s)');
            }
            if (!$valida3->isEmpty()){
                array_push($errors,'El proceso tiene documento(s) asociado(s)');
            }
            if (!$valida4->isEmpty()){
                array_push($errors,'El proceso está asociado con proceso(s)');
            }

            return redirect()->route('personanatural.index')->withErrors($errors);
        }
    }

    public function getCsv(){
        $Personasnaturales = Personanatural::orderBy('personanatural.id', 'ASC')
                                ->select('personanatural.*',  
                                'fondodepension.abreviatura AS fondodepension',
                                'tipodocumentoidentificacion.abreviatura AS tipodocumentoidentificacion',
                                'expedicion.lugar AS expedicion',
                                'eps.abreviatura AS eps', 
                                'grado.abreviatura AS grado',
                                'carrera.descripcion AS carrera',
                                'fuerza.abreviatura AS fuerza')
                                ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('expedicion','expedicion_id','=','expedicion.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id')->get();  
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($Personasnaturales, [
            'id',
            'codigo',
            'nombres',
            'apellidopaterno',
            'apellidomaterno',
            'tipodocumentoidentificacion_id',
            'tipodocumentoidentificacion',
            'numerodocumento',
            'expedicion_id' => 'lugarexpedicion_id',
            'expedicion' => 'lugarexpedicion',
            'fechaexpedicion',
            'fechanacimiento',
            'direccion',
            'eps_id',
            'eps',
            'fondodepension_id',
            'fondodepension',
            'grado_id',
            'grado',
            'carrera',
            'fuerza',
            'users_id',
            'created_at',
            'updated_at',
        ])->download();
    }
}
