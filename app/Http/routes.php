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


Route::get('/cliente',[
    'uses' => 'ProductsController@cliente',
    'as' => 'cliente'
]);

/* flow */

Route::post('pago', 'FlowController@pago')->name('pago');

Route::post('orden', 'FlowController@orden')->name('orden');

Route::post('flow/exito', 'FlowController@exito')->name('flow.exito');
Route::post('flow/fracaso', 'FlowController@fracaso')->name('flow.fracaso');
Route::post('flow/confirmacion', 'FlowController@confirmacion')->name('flow.confirmacion');
Route::post('flow/retorno', 'FlowController@retorno')->name('flow.retorno');







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