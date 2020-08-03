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

Route::get('/tienda', [
    'uses' => 'ProductsController@getTienda',
    'as' => 'almacen.tienda.index'
]);

Route::get('/agregar-al-carro/{id}', [
    'uses' => 'ProductsController@getAddtocart',
    'as' => 'almacen.tienda.addToCart'
]);

Route::get('/remover/{id}/{total}',[
    'uses' => 'ProductsController@getRemove',
    'as' => 'almacen.tienda.remover'
]);

Route::get('/removeritem/{id}', [
    'uses' => 'ProductsController@getRemoveAll',
    'as' => 'almacen.tienda.removeritem'
]);

Route::get('/carro-compra', [
    'uses' => 'ProductsController@getCarro',
    'as' => 'almacen.tienda.carroCompra'
]);


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
Route::get('/{slug?}', 'HomeController@index');