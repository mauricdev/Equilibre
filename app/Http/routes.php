<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('almacen/inicio/index');
});


Route::auth();

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/proveedor','proveedorController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/ventas','ventasController');
Route::resource('almacen/usuario','UsuarioController');
Route::resource('almacen/dashborad','HomeController');
Route::resource('almacen/persona','personaController');
Route::resource('almacen/ingreso','ingresoController');
Route::resource('auth/login','loginController');
Route::auth();

Route::get('/home', 'HomeController@index');
//Route::get('/{slug?}', 'HomeController@index');
Route::get('/exportar', 'HomeController@export');


//Reportes
Route::get('/exportarArticulo', 'ArticuloController@export');
Route::get('/exportarCategoria', 'CategoriaController@export');
Route::get('/exportarIngresos', 'ingresoController@export');
Route::get('/exportarProveedores', 'proveedorController@export');
Route::get('/exportarVenta', 'ventasController@export');
Route::get('/exportarPersona', 'personaController@export');