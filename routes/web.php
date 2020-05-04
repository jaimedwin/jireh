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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'InicioController@index')->name('inicio');
Route::get('validate_email', 'InicioController@validateEmail')->name('validate_email');  
Route::post('send_reset_email', 'InicioController@sendResetEmail')->name('send_reset_email');  
Route::get('reset_password/{token}', 'InicioController@resetPassword')->name('reset_password');
Route::get('change_password', 'InicioController@changePassword')->name('change_password');  

Route::get('consultacliente/', 'ConsultaclienteController@index')->name('consultacliente');
Route::post('consultacliente/validar', 'ConsultaclienteController@validarPost')->name('consultacliente.validarPost');
Route::get('consultacliente/validar', 'ConsultaclienteController@validarGet')->name('consultacliente.validarGet');
Route::get('consultacliente/logout', 'ConsultaclienteController@deleteCookies')->name('consultacliente.deleteCookies');

Route::get('consultacliente/descargas/{proceso}/{name}','ConsultaclienteController@downloadFile')->name('consultacliente.descargas');

Route::get('admin', 'AdminController@index')->name('admin');

Route::group(['prefix' => 'admin'], function () {
    //Auth::routes();
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});


Route::group(['prefix' => 'admin', 'middleware' => 'can:use-app-user'], function () {

    Route::group(['middleware' => 'can:use-app-download_csv'], function () {
        Route::get('personatural/get_csv','PersonanaturalController@getCsv')->name('personanatural.csv');
        Route::get('proceso/get_csv','ProcesoController@getCsv')->name('proceso.csv');
        Route::get('proceso/{id}/actuacion/get_csv','ProcesoActuacionController@getCsv')->name('proceso.actuacion.csv');
        Route::get('clienteproceso/get_csv','ClienteprocesoController@getCsv')->name('clienteproceso.csv');
    });

    Route::group(['middleware' => 'can:use-app-delete'], function () {
        Route::delete('estado/{id}','EstadoController@destroy')->name('estado.destroy');
        Route::delete('fondodepension/{id}', 'FondodepensionController@destroy')->name('fondodepension.destroy');
        Route::delete('tipodocumento/{id}', 'TipodocumentoController@destroy')->name('tipodocumento.destroy');
        Route::delete('eps/{id}', 'EpsController@destroy')->name('eps.destroy');
        Route::delete('fuerza/{id}', 'FuerzaController@destroy')->name('fuerza.destroy');
        Route::delete('fuerza/{fuerza}/carrera/{carrera}', 'FuerzaCarreraController@destroy')->name('fuerza.carrera.destroy');
        Route::delete('fuerza/{fuerza}/carrera/{carrera}/grado/{grado}', 'FuerzaCarreraGradoController@destroy')->name('fuerza.carrera.grado.destroy');
        Route::delete('municipio/{id}', 'MunicipioController@destroy')->name('municipio.destroy');
        Route::delete('tipocontrato/{id}', 'TipocontratoController@destroy')->name('tipocontrato.destroy');
        Route::delete('tipodocumentoidentificacion/{id}', 'TipodocumentoidentificacionController@destroy')->name('tipodocumentoidentificacion.destroy');
        Route::delete('tipodemanda/{id}', 'TipodemandaController@destroy')->name('tipodemanda.destroy');
        Route::delete('corporacion/{id}', 'CorporacionController@destroy')->name('corporacion.destroy');
        Route::delete('ponente/{id}', 'PonenteController@destroy')->name('ponente.destroy');
        Route::delete('ciudadproceso/{id}', 'CiudadprocesoController@destroy')->name('ciudadproceso.destroy');
        Route::delete('proceso/{id}', 'ProcesoController@destroy')->name('proceso.destroy');
        Route::delete('proceso/{proceso}/actuacion/{actuacion}', 'ProcesoActuacionController@destroy')->name('proceso.actuacion.destroy');
        Route::delete('proceso/{proceso}/documento/{documento}', 'ProcesoDocumentoController@destroy')->name('proceso.documento.destroy');
        Route::delete('proceso/{proceso}/recordatorio/{recordatorio}', 'ProcesoRecordatorioController@destroy')->name('proceso.recordatorio.destroy');
        Route::delete('contrato/{id}', 'ContratoController@destroy')->name('contrato.destroy');
        Route::delete('contrato/{contrato}/pago/{pago}', 'ContratoPagoController@destroy')->name('contrato.pago.destroy');
        Route::delete('personanatural/{id}', 'PersonanaturalController@destroy')->name('personanatural.destroy');
        Route::delete('personanatural/{personanatural}/telefono/{telefono}', 'PersonanaturalTelefonoController@destroy')->name('personanatural.telefono.destroy');
        Route::delete('personanatural/{personanatural}/correo/{correo}', 'PersonanaturalCorreoController@destroy')->name('personanatural.correo.destroy');
        Route::delete('documento/{id}', 'DocumentoController@destroy')->name('documento.destroy');
        Route::delete('personajuridica/{id}', 'PersonajuridicaController@destroy')->name('personajuridica.destroy');
        Route::delete('clienteproceso/{id}', 'ClienteprocesoController@destroy')->name('clienteproceso.destroy');
    });

    Route::resource('estado','EstadoController')->except('destroy');
    Route::resource('fondodepension', 'FondodepensionController')->except('destroy');
    Route::resource('tipodocumento', 'TipodocumentoController')->except('destroy');
    Route::resource('eps', 'EpsController')->except('destroy');
    Route::resource('fuerza', 'FuerzaController')->except('destroy');
    Route::resource('fuerza.carrera', 'FuerzaCarreraController')->except('destroy');
    Route::resource('fuerza.carrera.grado', 'FuerzaCarreraGradoController')->except('destroy');
    Route::resource('municipio', 'MunicipioController')->except('destroy');
    Route::resource('tipocontrato', 'TipocontratoController')->except('destroy');
    Route::resource('tipodocumentoidentificacion', 'TipodocumentoidentificacionController')->except('destroy');
    Route::resource('tipodemanda', 'TipodemandaController')->except('destroy');
    Route::resource('corporacion', 'CorporacionController')->except('destroy');
    Route::resource('ponente', 'PonenteController')->except('destroy');
    Route::resource('ciudadproceso', 'CiudadprocesoController')->except('destroy');
    Route::resource('proceso', 'ProcesoController')->except('destroy');
    Route::resource('proceso.actuacion', 'ProcesoActuacionController')->except('destroy');
    Route::resource('proceso.documento', 'ProcesoDocumentoController')->except('destroy');
    Route::resource('proceso.recordatorio', 'ProcesoRecordatorioController')->except('destroy');
    Route::resource('contrato', 'ContratoController')->except('destroy');
    Route::resource('contrato.pago', 'ContratoPagoController')->except('destroy');
    Route::resource('personanatural', 'PersonanaturalController')->except('destroy');
    Route::resource('personanatural.telefono', 'PersonanaturalTelefonoController')->except('destroy');
    Route::resource('personanatural.correo', 'PersonanaturalCorreoController')->except('destroy');
    Route::resource('documento', 'DocumentoController')->except('destroy');
    Route::resource('personajuridica', 'PersonajuridicaController')->except('destroy');
    Route::resource('clienteproceso', 'ClienteprocesoController')->except('destroy');

    Route::get('descargas_actuaciones/{proceso}/{name}','ProcesoActuacionController@downloadFile')->name('descargas_actuaciones');
    Route::get('descargas_proceso_documentos/{proceso}/{name}','ProcesoDocumentoController@downloadFile')->name('descargas_proceso_documentos');
    Route::get('descargas_otrosdocumentos/{personanatural}/{name}','DocumentoController@downloadFile')->name('descargas_otrosdocumentos');
    Route::get('descargas_otrosdocumentos_contrato/{personanatural}/{name}','ContratoController@downloadFile')->name('descargas_otrosdocumentos_contrato');
    Route::get('edit_profile/{id}', 'UserController@editProfile')->name('edit_profile');  
    Route::put('update_profile', 'UserController@updateProfile')->name('update_profile'); 
    Route::get('proceso/{id}/send_email','ProcesoController@sendEmail')->name('proceso.sendemail');
});

Route::group(['prefix' => 'admin', 'middleware' => 'can:use-app-admin'], function () {
    Route::resource('user', 'UserController')->except(['show', 'create', 'store', 'destroy']); 
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('copiadb','CopiabdController@index')->name('copiadb.index');
    Route::get('copiadb/create','CopiabdController@create')->name('copiadb.create');
    Route::get('descargas_copiasbasesdedatos/{name}','CopiabdController@downloadFile')->name('descargas_copiasbasesdedatos');
    Route::get('borrar_copiasbasesdedatos/{name}','CopiabdController@deleteFile')->name('borrar_copiasbasesdedatos');
    Route::get('registrosconsulta','RegistroconsultaController@index')->name('registroconsulta.index');
    Route::get('consultacorreo','ConsultacorreoController@index')->name('consultacorreo.index');
});







