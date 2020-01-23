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
    return view('Dashboard.dashboard');
});

Route::resource('Inventario/Categorias', 'CategoriaProductoController');
Route::resource('persona/cliente','ClienteController');
Route::resource('nomina/rol','RolController');