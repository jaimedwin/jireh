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
                                ->join('tipodocumentoidentificacion',
                                    'tipodocumentoidentificacion_id','=','tipodocumentoidentificacion.id')
                                ->join('expedicion','expedicion_id','=','expedicion.id')
                                ->join('eps','eps_id','=','eps.id')
                                ->join('fondodepension','fondodepension_id','=','fondodepension.id')
                                ->join('grado','grado_id','=','grado.id')
                                ->join('carrera','carrera.id','=','carrera_id')
                                ->join('fuerza', 'fuerza.id', '=', 'carrera.fuerza_id');  
        if (empty($palabrasbuscar)){            
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
        if($request->exists(['telefono_principal', 'correo_principal'])){   
            //dd($request->all());
            $grado = Personanatural::create($d);
            return redirect()->route('personanatural.index')
                ->with('success','Recordatorio del proceso almacenado completamente');
        }else{
            return Redirect::back()->withErrors(['Seleccione el correo y el telefono principal']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function show(Personanatural $personanatural)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function edit(Personanatural $personanatural)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personanatural $personanatural)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personanatural  $personanatural
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personanatural $personanatural)
    {
        //
    }
}
