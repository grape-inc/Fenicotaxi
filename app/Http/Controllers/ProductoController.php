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
        dd($Request);
        $Request->validate([            
            'Cod_Producto' => 'required',
            'Nombre_Producto' => 'required',
            'Descripcion_Producto' => 'required',
            'Existencias' => 'required',
            'Existencias_Minimas' => 'required',
            'Precio_Venta' => 'required',
            'ID_Categoria' => 'required',
            'ID_Proveedor' => 'required',
            'ID_Divisa' => 'required',
            'ID_UnidadMedida' => 'required',
            'Es_Repuesto' => 'required',
        ]);
        $Producto = new Producto();                
        $Producto->save();
        return redirect()->action('ProductoController@index');
    }

}
