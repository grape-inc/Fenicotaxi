<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Ingreso;
use App\IngresoDetalle;

class IngresoController extends Controller
{
    public function index(){
        $ingresos= DB::table('Ingreso as i')
        ->join('Proveedor as p','i.ID_Proveedor','=','p.ID_Proveedor')
        ->join('Empleado as e','i.ID_Empleado','=','e.ID_Empleado')
        ->join('Ingreso_detalle as ide','i.Codigo_Ingreso','=','ide.Codigo_Ingreso')
        ->join('Producto as prod','ide.ID_Producto','=','prod.ID_Producto')
        ->select('i.ID_Ingreso','i.Impuesto','i.Total','i.Fecha_Realizacion','p.Nombre_Proveedor','e.Nombre_Empleado','prod.Nombre_Producto','ide.Cantidad')
        ->get();
        return view('Inventario.Ingresos.index',["ingresos"=>$ingresos]);
    }

    public function create(){
        $empleado = DB::table('Empleado')->get();
        $proveedor = DB::table('Proveedor')->get();
        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();
        return view('Inventario.Ingresos.Create',["empleado"=>$empleado,"producto"=>$producto,"proveedor"=>$proveedor]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $request->validate([
                'ID_Proveedor' => 'required',
                'ID_Empleado' => 'required',
                'Impuesto' => 'required|numeric',
                'Total' => 'required|numeric',
                'Codigo_Ingreso' => 'required|numeric',
            ]);
           $ingreso=new Ingreso;
           $ingreso->ID_Proveedor=$request->get('ID_Proveedor');
           $ingreso->ID_Empleado=$request->get('ID_Empleado');
           $ingreso->Fecha_Realizacion = date('Y-m-d H:i:s');
           $ingreso->Impuesto=$request->get('Impuesto');
           $ingreso->Total=$request->get('Total');
           $ingreso->Codigo_Ingreso=$request->get('Codigo_Ingreso');
           $ingreso->save();

            $producto = $request->get('ID_Producto');
            $cantidad = $request->get('Cantidad');
            $precio = $request->get('Precio');
            $cont = 0;

            while($cont < count($producto)){
                $detalle = new IngresoDetalle();
                $detalle->Codigo_Ingreso = $ingreso->Codigo_Ingreso;
                $detalle->ID_Producto = $producto[$cont];
                $detalle->Cantidad= $cantidad[$cont];
                $detalle->Precio= $precio[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();

           }catch(\Exception $e)
           {
              DB::rollback();
           }

           return redirect()->action('IngresoController@index');

    }

}
