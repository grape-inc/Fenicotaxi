<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use DB;


class ProductoController extends Controller
{
    public function index(Request $Request){
        return view('Inventario.Productos.index') ->with('Productos', Producto::all());
    }

    public function create(Request $Request){            
        return view ('Inventario.Productos.create');
    }

    public function store(Request $Request){
        $Request->validate([            
            'Nombre_Proveedor' => 'required|max:80',
            'Direccion_Proveedor' => 'required'
        ]);
        $Producto = new Producto();                
        $Producto->save();
        return redirect()->action('ProductoController@index');
    }

}
