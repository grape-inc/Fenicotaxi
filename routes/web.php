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
Route::resource('Inventario/Proveedores', 'ProveedorController');
Route::resource('Inventario/Productos', 'ProductoController');
Route::resource('Configuracion/Divisa', 'DivisaController');
Route::resource('persona/cliente','ClienteController');
Route::resource('Nomina/Rol','RolController');
Route::resource('Inventario/UnidadesDeMedida','UnidadesDeMedidaController');
Route::resource('Nomina/Cargo','CargoController');
Route::resource('Facturacion/Arqueo','ArqueoController');