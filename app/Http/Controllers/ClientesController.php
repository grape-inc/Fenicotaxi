<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;
use app\Clientes;
use App\Http\Requests\CategoriaProductoFormRequest;
use Illuminate\Support\Facades\Redirect;
use app\Http\Requests\ClientesFormRequest;
use DB;

class ClientesController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request) {
        $clientes = DB::table('Cliente')->paginate(10);
        return view('Clientes.index',["Clientes"=>$clientes]);
    }

    public function create() {
        return view ('Clientes.create');
    }

    public function store(ClientesFormRequest $request) {
        $clientes= new Clientes;
        $clientes->Nombre_Cliente=$request->get('Nombre_Cliente');
        $clientes->Apellido_Cliente=$request->get('Apellido_Cliente');
        $clientes->Cedula=$request->get('Cedula');
        $clientes->Fecha_Ingreso=$request->get('Fecha_Ingreso');
        $clientes->Correo=$request->get('Correo');
        $clientes->Fecha_Realizacion=$request->get('Fecha_Realizacion');
        $clientes->save();
        return Redirect::to('Clientes/');
    }

    public function show($id) {
        return view("Clientes.show",["Clientes"=>Clientes::findOrFail($id)]);
    }

    public function edit($id) {
        return view("Clientes.edit",["Clientes"=>Clientes::findOrFail($id)]);
    }

    public function update(CategoriaProductoFormRequest $request,$id) {
        $clientes= Clientes::findOrFail($id);
        $clientes->Nombre_Cliente=$request->get('Nombre_Cliente');
        $clientes->Apellido_Cliente=$request->get('Apellido_Cliente');
        $clientes->Cedula=$request->get('Cedula');
        $clientes->Fecha_Ingreso=$request->get('Fecha_Ingreso');
        $clientes->Correo=$request->get('Correo');
        $clientes->Fecha_Realizacion=$request->get('Fecha_Realizacion');
        $clientes->update();
        return Redirect::to('Clientes');
    }

    public function destroy($ID) {
        $clientes=Clientes::findOrFail($ID);
        $clientes->where('ID_Cliente',$ID)->delete();
        return route('Clientes.index', ['Eliminado' => true]);
    }
}
