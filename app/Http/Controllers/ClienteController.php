<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    public function index(){
        return view('persona.cliente.index') ->with('Cliente', Cliente::all());
    }
    public function create(){
        return view('persona.cliente.create');
    }
    public function store(Request $request){
        $clientes = new Cliente();
        $clientes->Nombre_Cliente = $request->input('Nombre_Cliente');
        $clientes->Apellido_Cliente = $request->input('Apellido_Cliente');
        $clientes->Cedula = $request->input('Cedula');
        $clientes->Correo = $request->input('Correo');
        $clientes->Fecha_Realizacion = date('Y-m-d H:i:s');
        $clientes->Fecha_Ingreso = date('Y-m-d H:i:s');
        $clientes->save();
        return redirect()->action('ClienteController@index');
    }
    public function edit($id){
        $clientes = Cliente::find($id);
        return view('persona.cliente.edit',['cliente'=> $clientes]);
    }
    public function update(Request $request){
        $clientes = Cliente::find($request->input('ID_Cliente'));
        $clientes->Nombre_Cliente = $request->input('Nombre_Cliente');
        $clientes->Apellido_Cliente = $request->input('Apellido_Cliente');
        $clientes->Cedula = $request->input('Cedula');
        $clientes->Correo = $request->input('Correo');
        $clientes->Fecha_Realizacion = date('Y-m-d H:i:s');
        $clientes->save();
        return redirect()->action('ClienteController@index');
    }
    public function destroy($id){
        $clientes = Cliente::find($id);
        //delete
        $clientes->delete();
        return redirect()->action('CategoriaProductoController@index');
    }
}
