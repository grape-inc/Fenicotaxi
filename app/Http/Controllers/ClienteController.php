<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Http\Requests\ClientesFormRequest;
use Illuminate\Support\Facades\Redirect;

class ClienteController extends Controller
{
    public function index(){
        return view('Facturacion.Cliente.index') ->with('Cliente', Cliente::all());
    }
    public function create(){
        return view('Facturacion.Cliente.create');
    }
    public function store(ClientesFormRequest $request){
        $clientes = new Cliente();
        $clientes->Nombre_Cliente = $request->input('Nombre_Cliente');
        $clientes->Apellido_Cliente = $request->input('Apellido_Cliente');
        $clientes->Cedula = $request->input('Cedula');
        $clientes->Correo = $request->input('Correo');
        $clientes->Fecha_Realizacion = date('Y-m-d H:i:s');
        $clientes->Fecha_Ingreso = date('Y-m-d H:i:s');
        $clientes->Direccion = $request->input('Direccion');
        $clientes->save();
        return redirect()->action('ClienteController@index');
    }
    public function edit($id){
        $clientes = Cliente::find($id);
        return view('Facturacion.Cliente.edit',['cliente'=> $clientes]);
    }
    public function update(ClientesFormRequest $request,$ID){
        $clientes = Cliente::findOrFail($ID);
        $clientes->Nombre_Cliente = $request->get('Nombre_Cliente');
        $clientes->Apellido_Cliente = $request->get('Apellido_Cliente');
        $clientes->Cedula = $request->get('Cedula');
        $clientes->Correo = $request->get('Correo');
        $clientes->Fecha_Realizacion = date('Y-m-d H:i:s');
        $clientes->Direccion = $request->input('Direccion');
        $clientes->update();
        return redirect()->action('ClienteController@index');
    }
    public function destroy($id){
        $Eliminado = true;
        try {
            $clientes=Cliente::findOrFail($id);
            $clientes->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Cliente.index', ['Eliminado' => $Eliminado]);
    }
}
