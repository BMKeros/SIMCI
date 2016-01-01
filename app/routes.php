<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'AutenticacionController@getLogin'));

//Metodo para Ng-route
Route::get('/views/{nombre}', function($nombre) {
  	$view_path = $nombre;

  	if (View::exists($view_path)) {
    	return View::make($view_path);
  	}
  	App::abort(404);
});

Route::controller('/usuarios', 'UsuariosController');//ruta para los usuarios
Route::controller('/autenticacion', 'AutenticacionController');
Route::controller('/buscar', 'BusquedasController');//ruta para todas las busquedas del sistema
Route::controller('/modulos', 'ModulosController');
