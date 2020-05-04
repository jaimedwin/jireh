<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultacorreo;
use Carbon\Carbon;

class ConsultacorreoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $palabrasbuscar = explode(" ",$request->post('buscar'));
        $consultacorreos = Consultacorreo::orderBy('created_at', 'DESC')
                        ->select('consultacorreo.*', 'consultacorreotipo.descripcion AS consultacorreotipo')
                        ->join('consultacorreotipo','consultacorreotipo_id','=','consultacorreotipo.id');
        $emptypalabrasbuscar = array_filter($palabrasbuscar);
        if (!empty($emptypalabrasbuscar)){
            $columnas = ['consultacorreo.created_at', 'consultacorreo.a', 
            'consultacorreo.mensaje'];
            $Consultacorreos['Consultacorreos'] = $consultacorreos->whereOrSearch($palabrasbuscar, $columnas);
            return view('consultacorreo.index', $Consultacorreos)
                    ->with('success',['Busqueda realizada']);
        }else{
            $Consultacorreos['Consultacorreos'] = $consultacorreos->paginate(10);
            return view('consultacorreo.index', $Consultacorreos);
        }
    }
}
