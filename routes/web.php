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
    return redirect()->to( url('login') );
});

Auth::routes();
Route::get('logout', function(){
	Auth::logout();
	return redirect()->to( url('login') );
});

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
	Route::get('/', function(){
		return view('layouts.index');
	});


	Route::get('plantaciones/nueva_fila', 'PlantacionesController@nuevaFila');
	Route::get('plantaciones/nueva_fila', function(){
        $vista = \View::make('paginas.plantaciones.fila')->render();
        return response(['vista' => $vista], 200)->header('Content-Type', 'application/json');
	});

	Route::resource('tipos', 'TiposController');
	Route::resource('almacen', 'AlmacenController');
	Route::resource('unidades', 'UnidadesController');
	Route::resource('movimientos', 'MovimientosInventarioController');
	Route::resource('patios', 'PatioController');
	Route::resource('plantaciones', 'PlantacionesController');

});