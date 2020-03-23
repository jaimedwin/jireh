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

Auth::routes();

Route::get('admin', 'HomeController@index')->name('admin');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('estado','EstadoController');
    Route::resource('fondodepension', 'FondodepensionController');
    Route::resource('tipodocumento', 'TipodocumentoController');
    Route::resource('eps', 'EpsController');
    Route::resource('fuerza', 'FuerzaController');
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
    Route::get('descargas/{proceso_id}/{name}','ProcesoActuacionController@downloadFile')->name('descargas');
});







