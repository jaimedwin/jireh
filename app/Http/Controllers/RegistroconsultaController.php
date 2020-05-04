<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registroconsulta;

class RegistroconsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $registrosconsulta = Registroconsulta::orderBy('created_at', 'DESC')
                        ->select('registroconsulta.*', 'personanatural.numerodocumento AS numerodocumento',
                                    'proceso.numero AS proceso')
                        ->selectRaw('CONCAT(personanatural.nombres, " ", personanatural.apellidopaterno, " ", personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('personanatural','personanatural_id','=','personanatural.id')
                        ->join('proceso', 'proceso_id', '=', 'proceso.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['registroconsulta.created_at', 'personanatural.numerodocumento', 
            'personanatural.nombres', 'personanatural.apellidopaterno', 
            'personanatural.apellidomaterno', 'proceso.numero'];
            $Registrosconsulta['Registrosconsulta'] = $registrosconsulta->whereOrSearch($palabrasbuscar, $columnas);
            return view('registroconsulta.index', $Registrosconsulta)
            ->with('success',['Busqueda realizada']);
        }else{
            $Registrosconsulta['Registrosconsulta'] = $registrosconsulta->paginate(10);
            return view('registroconsulta.index', $Registrosconsulta);
        }
    }
}
