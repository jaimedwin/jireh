<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
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
    public function index()
    {
        $usuarios = User::all();

        return view('auth.index', compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('auth.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request->user);
        if (Gate::denies('manager-users')){
            return redirect()->route('admin')->withErrors('Usuario no autorizado');
        }
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('user.index');
    }

    public function validateEmail(){
        $token = Str::random(60);
        return view('auth.passwords.email', ['token' => $token]);
    }

    public function resetPassword(Request $request){

        $user = User::select('email')->find(Auth::id());

        
        if($request->email == $user->email){
            $token = $request->token;
            $email = $request->email;
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

            return view('auth.passwords.reset', ['email' => $email, 'token' => $token]);
            
        }
        
        return redirect()->route('admin')->withErrors(['Usuario no autorizado']);
        // $token = User::select('password')->find(Auth::id());
        // $token->password
        
    }

    public function changePassword(Request $request){

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if(($request->email == $user->email) && ($request->password == $request->password_confirmation) && $user){
            
            $token = $request->token;
            
            $password = $request->password;

            $tokenData = DB::table('password_resets')
                ->where('token', $token)->first();

            // Validate the token
            if(!$tokenData){
                return redirect()->route('admin')->withErrors(['Error en el token']);
            }

            $user->password = \Hash::make($password);
            $user->update(); //or $user->save();

            //login the user immediately they change password successfully
            Auth::login($user);

            //Delete the token
            DB::table('password_resets')->where('email', $email)
            ->delete();
            return redirect()->route('admin')->with('succes', ['Contraseña actualizada']);
        }

        return redirect()->route('admin')->withErrors(['Usuario no autorizado']);

    }

    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        return view('auth.edit_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return redirect()->route('admin')->with('success',['Información de usuario actualizada']);
    }
}
