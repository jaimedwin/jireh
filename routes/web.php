<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', 'HomeController@index')->name('admin');

Route::group(['prefix' => 'admin'], function () {
    //Auth::routes();
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});


Route::group(['prefix' => 'admin', 'middleware' => 'can:use-app'], function () {
    Route::resource('estado','EstadoController');
    Route::resource('fondodepension', 'FondodepensionController');
    Route::resource('tipodocumento', 'TipodocumentoController');
    Route::resource('eps', 'EpsController');
    Route::resource('fuerza', 'FuerzaController');
    Route::resource('fuerza.carrera', 'FuerzaCarreraController');
    Route::resource('fuerza.carrera.grado', 'FuerzaCarreraGradoController');
    Route::resource('expedicion', 'ExpedicionController');
    Route::resource('tipocontrato', 'TipocontratoController');
    Route::resource('tipodocumentoidentificacion', 'TipodocumentoidentificacionController');
    Route::resource('tipodemanda', 'TipodemandaController');
    Route::resource('corporacion', 'CorporacionController');
    Route::resource('ponente', 'PonenteController');
    Route::resource('ciudadproceso', 'CiudadprocesoController');
    Route::resource('proceso', 'ProcesoController');
    Route::resource('proceso.actuacion', 'ProcesoActuacionController');
    Route::resource('proceso.recordatorio', 'ProcesoRecordatorioController');
    Route::resource('contrato', 'ContratoController');
    Route::resource('contrato.pago', 'ContratoPagoController');
    Route::resource('personanatural', 'PersonanaturalController');
    Route::resource('personanatural.telefono', 'PersonanaturalTelefonoController');
    Route::resource('personanatural.correo', 'PersonanaturalCorreoController');
    Route::resource('documento', 'DocumentoController');
    Route::resource('personajuridica', 'PersonajuridicaController');
    Route::resource('clienteproceso', 'ClienteprocesoController');
    Route::get('descargas_actuaciones/{proceso}/{name}','ProcesoActuacionController@downloadFile')->name('descargas_actuaciones');
    Route::get('descargas_otrosdocumentos/{personanatural}/{name}','ContratoController@downloadFile')->name('descargas_otrosdocumentos');
    Route::get('copiadb','CopiabdController@index')->name('copiadb.index');
    Route::get('copiadb/create','CopiabdController@create')->name('copiadb.create');
    Route::get('descargas_copiasbasesdedatos/{name}','CopiabdController@downloadFile')->name('descargas_copiasbasesdedatos');
    Route::get('borrar_copiasbasesdedatos/{name}','CopiabdController@deleteFile')->name('borrar_copiasbasesdedatos');
    Route::get('get_csv/personatural','PersonanaturalController@getCsv')->name('personanatural.csv');
    Route::get('get_csv/proceso','ProcesoController@getCsv')->name('proceso.csv');
    Route::get('get_csv/proceso/{id}/actuacion','ProcesoActuacionController@getCsv')->name('proceso.actuacion.csv');
    Route::get('validate_email', 'UserController@validateEmail')->name('validate_email');  
    Route::post('reset_password/{token}', 'UserController@resetPassword')->name('reset_password');
    Route::get('change_password/{email}/{token}', 'UserController@changePassword')->name('change_password');  
    Route::get('edit_profile/{id}', 'UserController@editProfile')->name('edit_profile');  
    Route::put('update_profile', 'UserController@updateProfile')->name('update_profile'); 
    Route::get('proceso/{id}/send_email','ProcesoController@sendEmail')->name('proceso.sendemail');
});

Route::group(['prefix' => 'admin', 'middleware' => 'can:manager-users'], function () {
    Route::resource('user', 'UserController')->except(['show', 'create', 'store', 'destroy']); 
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});







