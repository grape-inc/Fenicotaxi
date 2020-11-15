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
Route::get('/', 'LoginController@index');
Route::get('Login/matar_sesion', 'LoginController@matar_sesion');
Route::resource('Login','LoginController');
Route::resource('Inventario/Categorias', 'CategoriaProductoController')->middleware('peticionautenticada');
Route::resource('Inventario/Proveedores', 'ProveedorController')->middleware('peticionautenticada');
Route::resource('Inventario/Productos', 'ProductoController')->middleware('peticionautenticada');
Route::resource('Inventario/Ingresos', 'IngresoController')->middleware('peticionautenticada');
Route::resource('Configuracion/Divisa', 'DivisaController')->middleware('peticionautenticada');
Route::resource('Configuracion/Usuarios', 'UsuarioController')->middleware('peticionautenticada');
Route::resource('Facturacion/Cliente','ClienteController')->middleware('peticionautenticada');
Route::resource('Nomina/Rol','RolController')->middleware('peticionautenticada');
Route::resource('Nomina/Empleado','EmpleadoController')->middleware('peticionautenticada');
Route::resource('Nomina/Horas','HorasController')->middleware('peticionautenticada');
Route::resource('Nomina/Nomina','NominaController')->middleware('peticionautenticada');
Route::resource('Inventario/UnidadesDeMedida','UnidadesDeMedidaController')->middleware('peticionautenticada');
Route::resource('Nomina/Cargo','CargoController')->middleware('peticionautenticada');
Route::resource('Facturacion/Arqueo','ArqueoController')->middleware('peticionautenticada');
Route::resource('Facturacion/Venta','FacturaVentaController')->middleware('peticionautenticada');
Route::resource('Facturacion/TipoPago','TipoPagoController')->middleware('peticionautenticada');
Route::resource('Welcome','WelcomeController')->middleware('peticionautenticada');

//Peticiones ajax
Route::get('valoresCalculo','FacturaVentaController@valoresCalculo');
Route::get('info_productos','ProductoController@ajax_producto');
Route::get('precio_producto/{Producto}','ProductoController@precio_producto');
Route::get('info_factura','FacturaVentaController@ajax_factura');
Route::get('factura_pdf','FacturaVentaController@pdf_factura');