<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mail\SendResetPassword;
use App\Models\Consultacorreo;
use App\User;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index(){
        return view('bienvenido');
    }

    public function user(Request $request){
        return $request->user();
    }

    public function validateEmail(){
        $token = Str::random(60);
        return view('auth.passwords.email', ['token' => $token]);
    }

    public function sendResetEmail(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:320', 
            'token_recaptcha' => 'required',
            'token' => 'required|max:60|min:60',
            'action' => 'required',
            ]);
        
        if ($validator->fails()) {
            return redirect()->route('validate_email')
                            ->withErrors($validator);
        }

        $token_recaptcha = $request->token_recaptcha;
        $action = $request->action;
             
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        $recaptcha_secret = config('app.secret_key'); 
        $recaptcha_response = $token_recaptcha; 
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
        $recaptcha = json_decode($recaptcha); 
        
        if(!($recaptcha->success && $recaptcha->score > 0.5 && $recaptcha->action == $action)){
            return redirect()->route('consultacliente')->withErrors(['Se ha registrado una actividad sospechosa']);
        }

        $email = $request->email;
        $token = $request->token;
        $user = User::select('id', 'email')->where('email', '=', $email)->first();

        if(!is_null($user)){
            
            //Delete the token
            DB::table('password_resets')->where('email', $email)
            ->delete();
            
            //Create Password Reset Token
            $password_reset = DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // Validate the token
            if(!$password_reset){
                return redirect()->route('admin')->withErrors('Error al generar el token');
            }

            $url = url('/') . '/reset_password/' . $token;
            $subject = 'Cambio de contraseña';
            Mail::to($email)->send(new SendResetPassword($url, $subject));

            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
            
        }
        
        return redirect()->route('validate_email')->withErrors(['Error al validar el correo']);
        
    }

    public function resetPassword($token){
        $tokenData = DB::table('password_resets')
                ->where('token', $token)->first();

            // Validate the token
        if(!$tokenData){
                return abort(404);
        }
        return view('auth.passwords.reset', compact('token'));
    }

    public function changePassword(Request $request){

        $email = $request->email;
        $token = $request->token;
        $user = User::where('email', $email)->first();
        
        if(!($request->password == $request->password_confirmation)){
            return redirect()->back()->withErrors(['Las contraseñas no son iguales']);
        }

        if(!is_null($user)){
            
            $password = $request->password;

            $tokenData = DB::table('password_resets')
                ->where('token', $token)->first();

            // Validate the token
            if(!$tokenData){
                return redirect()->route('login')->withErrors(['Error en el token']);
            }

            $user->password = \Hash::make($password);
            $user->update(); //or $user->save();

            // Registra que usuario de la base de datos pidio cambio de contraseña
            $consultacorreo = new Consultacorreo;
            $consultacorreo->a = $email;
            $consultacorreo->mensaje = '';
            $consultacorreo->consultacorreotipo_id = 1;
            $consultacorreo->created_at = Carbon::now();
            $consultacorreo->save();

            //login the user immediately they change password successfully
            Auth::login($user);

            //Delete the token
            DB::table('password_resets')->where('email', $email)
            ->delete();

            return redirect()->route('admin')->with('succes', ['Contraseña actualizada']);
        }

        return redirect()->route('login')->withErrors(['Usuario no autorizado', 'Error al validar el correo electronico']);

    }
}
