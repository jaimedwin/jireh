<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clienteproceso;
use App\Models\Registroconsulta;
use App\Models\Proceso;
use App\Models\Actuacionproceso;
use App\Models\Personanatural;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class ConsultaclienteController extends Controller
{
    const PATH = 'actuaciones/';

    public function index(){
        return view('consultacliente.index');
    }

    public function validarPost(Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'cliente_codigo' => 'required|string|max:15',
            'proceso_codigo' => 'required|string|max:15',
            'cliente_contraseña' => 'required|date_format:dmY|max:8|min:8', 
            'token' => 'required',
            'action' => 'required',
            ]);
        
        if ($validator->fails()) {
            return redirect()->route('consultacliente')
                            ->withErrors($validator);
        }

        $token = $request->token;
        $action = $request->action;
             
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        $recaptcha_secret = config('app.secret_key'); 
        $recaptcha_response = $token; 
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
        $recaptcha = json_decode($recaptcha); 
        
        if(!($recaptcha->success && $recaptcha->score > 0.5 && $recaptcha->action == $action)){
            return redirect()->route('consultacliente')->withErrors(['Se ha registrado una actividad sospechosa']);
        }
        
        $proceso_codigo = $request->proceso_codigo;
        $cliente_codigo = $request->cliente_codigo;
        $cliente_fechaexpedicion = $request->cliente_contraseña;

        return $this->validar($proceso_codigo, $cliente_codigo, $cliente_fechaexpedicion);
    }

    public function validarGet(){
        $cliente_codigo = $this->getCookie('jireh_cliente_codigo');
        $proceso_codigo = $this->getCookie('jireh_proceso_codigo');
        $date = $this->getCookie('jireh_cliente_fechaexpedicion');
        $cliente_fechaexpedicion = date("dmY", strtotime($date));
        return $this->validar($proceso_codigo, $cliente_codigo, $cliente_fechaexpedicion);
    }

    private function validar($proceso_codigo, $cliente_codigo, $cliente_fechaexpedicion){
        $cliente_fechaexpedicion = \Carbon\Carbon::createFromFormat('dmY',$cliente_fechaexpedicion)->format('Y/m/d');
        $consulta = Clienteproceso::select('clienteproceso.id', 'clienteproceso.proceso_id', 
                        'clienteproceso.personanatural_id', 'proceso.codigo AS proceso_codigo',
                        'personanatural.codigo AS personanatural_codigo')
                        ->selectRaw('CONCAT_WS(" ", personanatural.nombres, personanatural.apellidopaterno, personanatural.apellidomaterno) AS nombrecompleto')
                        ->join('personanatural', 'personanatural_id', '=', 'personanatural.id')
                        ->join('proceso', 'proceso_id', '=', 'proceso.id')
                        ->where('proceso.codigo', $proceso_codigo)
                        ->where('personanatural.codigo', $cliente_codigo)
                        ->where('personanatural.fechaexpedicion', $cliente_fechaexpedicion)
                        ->first();

        if(!is_null($consulta)){
            $minutes = 15;

            $response1 = Cookie::queue('jireh_cliente_codigo', $cliente_codigo, $minutes);
            $response2 = Cookie::queue('jireh_proceso_codigo', $proceso_codigo, $minutes);
            $response3 = Cookie::queue('jireh_cliente_fechaexpedicion', $cliente_fechaexpedicion, $minutes);

            
            $Proceso = Proceso::select(
                            'proceso.*',
                            'ciudadproceso.nombre AS ciudadproceso', 
                            'corporacion.nombre AS corporacion', 
                            'ponente.nombrecompleto AS ponente', 
                            'estado.descripcion AS estado')
                        ->join('ciudadproceso', 'proceso.ciudadproceso_id', '=', 'ciudadproceso.id')
                        ->join('corporacion','proceso.corporacion_id', '=', 'corporacion.id')
                        ->join('ponente', 'proceso.ponente_id', '=', 'ponente.id')
                        ->join('estado', 'proceso.estado_id', '=', 'estado.id')
                        ->findOrFail($consulta->proceso_id);
            $Actuacionesproceso = Actuacionproceso::orderBy( 'fechaactuacion', 'DESC')
                        ->where('proceso_id', '=', $consulta->proceso_id)->get();
            
            // Genera cookies

            // Registra el acceso del cliente
            $registroconsulta = new Registroconsulta;
            $registroconsulta->proceso_id = $consulta->proceso_id;
            $registroconsulta->personanatural_id = $consulta->personanatural_id;
            $registroconsulta->created_at = Carbon::now();
            $registroconsulta->save();
            
            // Actualiza el contrato
            $personanatural = Personanatural::findOrfail($consulta->personanatural_id);
            $personanatural->contrato = 1;
            $personanatural->update();

            return view('consultacliente.info', compact('consulta', 'Proceso', 'Actuacionesproceso'));
        }
         
        return redirect()->route('consultacliente');
    }

    public function getCookie($name)
    {
        return Cookie::get($name);
    }

    public function deleteCookies()
    {
        \Cookie::queue(\Cookie::forget('jireh_cliente_codigo'));
        \Cookie::queue(\Cookie::forget('jireh_proceso_codigo'));
        \Cookie::queue(\Cookie::forget('jireh_cliente_fechaexpedicion'));

        return redirect()->route('consultacliente')
            ->with(['Se cerro sesión correctamente']);
    }

    public function downloadFile($id, $name)
    {
        
        $file = Storage::exists(self::PATH. $id.'/'. $name);
        if ($file){
            return Storage::download(self::PATH. $id.'/'.$name);
        }
        return redirect()->route('consultacliente')->withErrors(['No se encuentra el archivo: '. $name]);
    }
}
