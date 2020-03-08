<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProveedorController extends Controller
{
    public function index(Request $Request){
        return view('Inventario.Proveedor.index') ->with('Proveedor', Proveedor::all());
    }

    public function create(){
        return view ('Inventario.Proveedor.create');
    }

    public function store(Request $Request){
        $Request->validate([            
            'Nombre_Proveedor' => 'required|max:80',
            'Direccion_Proveedor' => 'required',
            'Telefono' => 'required',
            'Contacto_Proveedor' => 'required'
        ]);
        $Proveedor = new Proveedor();        
        $Proveedor->Nombre_Proveedor=$Request->get('Nombre_Proveedor');
        $Proveedor->Direccion_Proveedor=$Request->get('Direccion_Proveedor');
        $Proveedor->Telefono=$Request->get('Telefono');
        $Proveedor->Contacto_Proveedor=$Request->get('Contacto_Proveedor');
        $Proveedor->save();
        return redirect()->action('ProveedorController@index');
    }

    public function edit($ID){
        return view("Inventario.Proveedor.edit ",["Proveedor"=>Proveedor::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Request->validate([            
            'Nombre_Proveedor' => 'required|max:80',
            'Direccion_Proveedor' => 'required',
            'Telefono' => 'required',
            'Contacto_Proveedor' => 'required'
        ]);
        $Proveedor = Proveedor::findOrFail($ID);
        $Proveedor->Nombre_Proveedor=$Request->get('Nombre_Proveedor');
        $Proveedor->Direccion_Proveedor=$Request->get('Direccion_Proveedor');
        $Proveedor->Telefono=$Request->get('Telefono');
        $Proveedor->Contacto_Proveedor=$Request->get('Contacto_Proveedor');
        $Proveedor->update();    
        return redirect()->action('ProveedorController@index');
    }
    public function destroy($ID){
        $Proveedor=Proveedor::findOrFail($ID);
        $Proveedor->where('ID_Proveedor',$ID)->delete();
        return route('Proveedores.index', ['Eliminado' => true]);
    }
}
