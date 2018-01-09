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

Route::resource('/almacen/categoria', 'CategoriaController');

Route::resource('/almacen/articulo', 'ArticuloController');

Route::resource('/ventas/cliente', 'ClienteController');

Route::resource('/compras/proveedor', 'ProveedorController');

Route::resource('/compras/ingreso', 'IngresoController');