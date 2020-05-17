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
    return view('Login.index');
});

Route::resource('Login','LoginController');
Route::resource('Inventario/Categorias', 'CategoriaProductoController');
Route::resource('Inventario/Proveedores', 'ProveedorController');
Route::resource('Inventario/Productos', 'ProductoController');
Route::resource('Inventario/Ingresos', 'IngresoController');
Route::resource('Configuracion/Divisa', 'DivisaController');
Route::resource('Configuracion/Usuarios', 'UsuarioController');
Route::resource('Facturacion/Cliente','ClienteController');
Route::resource('Nomina/Rol','RolController');
Route::resource('Nomina/Empleado','EmpleadoController');
Route::resource('Nomina/Horas','HorasController');
Route::resource('Nomina/Nomina','NominaController');
Route::resource('Inventario/UnidadesDeMedida','UnidadesDeMedidaController');
Route::resource('Nomina/Cargo','CargoController');
Route::resource('Facturacion/Arqueo','ArqueoController');
Route::resource('Facturacion/Venta','FacturaVentaController');
Route::resource('Facturacion/TipoPago','TipoPagoController');
Route::resource('Welcome','WelcomeController');

//Peticiones ajax
Route::get('valoresCalculo','FacturaVentaController@valoresCalculo');
Route::get('info_productos','ProductoController@ajax_producto');
Route::get('precio_producto/{Producto}','ProductoController@precio_producto');
Route::get('info_factura','FacturaVentaController@ajax_factura');
Route::get('factura_pdf','FacturaVentaController@pdf_factura');