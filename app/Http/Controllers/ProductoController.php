<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\CategoriaProducto;
use App\Proveedor;
use App\Divisa;
use App\UnidadMedida;
use Illuminate\Support\Facades\Redirect;
use DB;


class ProductoController extends Controller
{
    public function index(Request $Request){
        $Productos = DB::table('producto')
            ->join('categoria_producto', 'producto.id_categoria', '=', 'categoria_producto.id_categoria')
            ->join('proveedor', 'producto.id_proveedor', '=', 'proveedor.id_proveedor')
            ->get();        
        return view('Inventario.Productos.index') ->with('Productos',$Productos);
    }

    public function create(Request $Request){        
        $Categorias =  CategoriaProducto::all();
        $Proveedores =  Proveedor::all();
        $Divisas =  Divisa::all();
        $UnidadMedidas =  UnidadMedida::all();
        return view ('Inventario.Productos.create',[
            'Categorias' => $Categorias, 
            'Proveedores' => $Proveedores,
            'Divisas' => $Divisas,
            'Unidades' => $UnidadMedidas
        ]);
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
