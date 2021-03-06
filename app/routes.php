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
Route::get('/views/{folder}/{name_template}', function ($folder, $name_template) {

    $view_path = $folder . "." . $name_template;

    if (View::exists($view_path)) {
        return View::make($view_path);
    } else {
        return Response::json("Vista no Encontrada [404]", 404);
    }
});

Route::get('/estadisticas', function () {
    $datos = DB::select(RAW("SELECT
        (SELECT count(*) FROM usuarios)::INTEGER AS total_usuarios,
        (SELECT count(*) FROM catalogo_objetos)::INTEGER AS total_objetos,
        (SELECT count(*) FROM inventario)::INTEGER AS total_elementos,
        (SELECT count(*) FROM ordenes WHERE status = '" . ACTIVA . "' )::INTEGER AS total_ordenes_activas,
        (SELECT count(*) FROM ordenes WHERE status = '" . PENDIENTE . "' )::INTEGER AS total_ordenes_pendientes;
    "));
    

    return Response::json(['indicadores' => $datos[0]]);
});

//Aqui van todos los controladores que se prestaran como api
Route::group(array('prefix' => 'api'), function () {
    Route::controller('/usuarios', 'UsuariosController');
    Route::controller('/personas', 'PersonasController');
    Route::controller('/inventario', 'InventarioController');
    Route::controller('/catalogo', 'CatalogoController');
    Route::controller('/laboratorio', 'LaboratorioController');
    Route::controller('/notificaciones', 'NotificacionesController');
    Route::controller('/consultas', 'ConsultasController');
    Route::controller('/proveedores', 'ProveedoresController');
    Route::controller('/pedidos', 'PedidosController');
    Route::controller('/ordenes', 'OrdenesController');
    Route::controller('/correos', 'CorreosController');
    Route::controller('/reportes', 'ReportesController');
});

Route::controller('/autenticacion', 'AutenticacionController');
Route::controller('/modulos', 'ModulosController');
Route::controller('/datasheet', 'DataSheetController');
