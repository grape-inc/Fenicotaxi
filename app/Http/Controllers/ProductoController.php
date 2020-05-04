<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\CategoriaProducto;
use App\Proveedor;
use App\Divisa;
use App\UnidadMedida;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use DB;


class ProductoController extends Controller
{
    public function index(Request $Request){
        if($Request->Tipo_Existencia == 1){
          $Productos = DB::table('Producto')
            ->join('Categoria_Producto', 'Producto.id_categoria', '=', 'Categoria_Producto.id_categoria')
            ->join('Proveedor', 'Producto.id_proveedor', '=', 'Proveedor.id_proveedor')
            ->join('Divisa', 'Producto.ID_Divisa', '=', 'Divisa.ID_Divisa')
            ->whereColumn('Existencias', '>=', 'Existencias_Minimas')->get();
        }
        else if ($Request->Tipo_Existencia == 2){
            $Productos = DB::table('Producto')
            ->join('Categoria_Producto', 'Producto.id_categoria', '=', 'Categoria_Producto.id_categoria')
            ->join('Proveedor', 'Producto.id_proveedor', '=', 'Proveedor.id_proveedor')
            ->join('Divisa', 'Producto.ID_Divisa', '=', 'Divisa.ID_Divisa')
            ->whereColumn('Existencias', '<', 'Existencias_Minimas')->get();
        }
        else {
            $Productos = DB::table('Producto')
            ->join('Categoria_Producto', 'Producto.id_categoria', '=', 'Categoria_Producto.id_categoria')
            ->join('Divisa', 'Producto.ID_Divisa', '=', 'Divisa.ID_Divisa')
            ->join('Proveedor', 'Producto.id_proveedor', '=', 'Proveedor.id_proveedor')->get();
        }
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

    public function edit($ID){
        $Categorias =  CategoriaProducto::all();
        $Proveedores =  Proveedor::all();
        $Divisas =  Divisa::all();
        $UnidadMedidas =  UnidadMedida::all();
        return view ('Inventario.Productos.edit',[
            'Categorias' => $Categorias,
            'Proveedores' => $Proveedores,
            'Divisas' => $Divisas,
            'Unidades' => $UnidadMedidas,
            'Producto' => Producto::findOrFail($ID),
        ]);
    }

    public function store(Request $Request){
        $Base = "";
        $EsRepuesto = true;
        if ($Request->hasFile('Imagen')) {
            $Base = $Request->file('Imagen')->getRealPath();
            $Base = file_get_contents($Base);
            $Base = base64_encode($Base);
        }

        if($Request->Es_Repuesto == null){
           $EsRepuesto = false;
        }
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
            'ID_UnidadMedida' => 'required'
        ]);
        $Producto = new Producto();
        $Producto->Cod_Producto=$Request->get('Cod_Producto');
        $Producto->Nombre_Producto=$Request->get('Nombre_Producto');
        $Producto->Descripcion_Producto=$Request->get('Descripcion_Producto');
        $Producto->Existencias=$Request->get('Existencias');
        $Producto->Existencias_Minimas=$Request->get('Existencias_Minimas');
        $Producto->Precio_Venta=$Request->get('Precio_Venta');
        $Producto->ID_Categoria=$Request->get('ID_Categoria');
        $Producto->ID_Proveedor=$Request->get('ID_Proveedor');
        $Producto->ID_UnidadMedida=$Request->get('ID_UnidadMedida');
        $Producto->ID_Divisa=$Request->get('ID_Divisa');
        $Producto->Es_Repuesto=$EsRepuesto;
        $Producto->Año=$Request->get('Año');
        $Producto->Modelo=$Request->get('Modelo');
        $Producto->Origen=$Request->get('Origen');
        $Producto->Marca=$Request->get('Marca');
        $Producto->Imagen=$Base;
        $Producto->save();
        return redirect()->action('ProductoController@index');
    }

    public function update(Request $Request, $ID){
        $Base = "";
        $EsRepuesto = true;
        if ($Request->hasFile('Imagen')) {
            $Base = $Request->file('Imagen')->getRealPath();
            $Base = file_get_contents($Base);
            $Base = base64_encode($Base);
        }

        if($Request->Es_Repuesto == null){
           $EsRepuesto = false;
        }
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
            'ID_UnidadMedida' => 'required'
        ]);
        $Producto = Producto::findOrFail($ID);
        $Producto->Cod_Producto=$Request->get('Cod_Producto');
        $Producto->Nombre_Producto=$Request->get('Nombre_Producto');
        $Producto->Descripcion_Producto=$Request->get('Descripcion_Producto');
        $Producto->Existencias=$Request->get('Existencias');
        $Producto->Existencias_Minimas=$Request->get('Existencias_Minimas');
        $Producto->Precio_Venta=$Request->get('Precio_Venta');
        $Producto->ID_Categoria=$Request->get('ID_Categoria');
        $Producto->ID_Proveedor=$Request->get('ID_Proveedor');
        $Producto->ID_UnidadMedida=$Request->get('ID_UnidadMedida');
        $Producto->ID_Divisa=$Request->get('ID_Divisa');
        $Producto->Es_Repuesto=$EsRepuesto;
        $Producto->Año=$Request->get('Año');
        $Producto->Modelo=$Request->get('Modelo');
        $Producto->Origen=$Request->get('Origen');
        $Producto->Marca=$Request->get('Marca');
        if ($Base != ""){
            $Producto->Imagen=$Base;
        }
        $Producto->update();
        return redirect()->action('ProductoController@index');
    }

    public function destroy($ID){
        $Eliminado = true;
        try {
            $Producto=Producto::findOrFail($ID);
            $Producto->where('ID_Producto',$ID)->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Productos.index', ['Eliminado' => $Eliminado]);
    }

    public function ajax_producto(){
        $Categorias =  CategoriaProducto::all();
        $Proveedores =  Proveedor::all();
        $Divisas =  Divisa::all();
        $UnidadMedidas =  UnidadMedida::all();
        return response()->json([
            'Categorias' => $Categorias,
            'Proveedores' => $Proveedores,
            'Divisas' => $Divisas,
            'UnidadMedida' => $UnidadMedidas,
        ]);
    }

    public function precio_producto($ID){
        $Producto = Producto::findOrFail($ID);
        return response()->json([
            'Producto' => $Producto
        ]);
    }
}
