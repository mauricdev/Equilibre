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
    return view('auth/login');
});


Route::auth();

Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/proveedor','proveedorController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/ventas','ventasController');
Route::resource('almacen/usuario','UsuarioController');
Route::resource('almacen/dashborad','inicioController');
Route::resource('almacen/persona','personaController');
Route::auth();

Route::get('/home', 'HomeController@index');
//Route::get('/{slug?}', 'HomeController@index');