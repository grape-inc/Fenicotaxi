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
        ->join('Proveedor as p','i.ID_Proveedor','=','i.ID_Proveedor')
        ->join('Empleado as e','i.ID_Empleado','=','e.ID_Empleado')
        ->join('Ingreso_detalle as ide','i.ID_Ingreso','=','ide.ID_Ingreso')
        ->join('Producto as prod','ide.ID_Producto','=','prod.ID_Producto')
        ->select('i.ID_Ingreso','i.Fecha_Realizacion','p.Nombre_Proveedor','e.Nombre_Empleado','prod.Nombre_Producto','ide.Cantidad')
        ->get();
        return view('Inventario.Ingresos.index',["ingresos"=>$ingresos]);
    }

    public function create(){
        $empleado = DB::table('Empleado')->get();
        $cliente = DB::table('Cliente')->get();
        $divisa = DB::table('Divisa')->get();
        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();
        return view('Inventario.Ingresos.Create',["empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa]);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $facturaventa=new FacturaVenta;
            $facturaventa->Codigo_Factura=$request->get('Codigo_Factura');
            $facturaventa->ID_Divisa=$request->get('ID_Divisa');

            $facturaventa->Es_Credito= true;
            if ($request->get('Descuento') == Null){
                $facturaventa->Es_Credito=false;
            }

            $facturaventa->Descuento=$request->get('Descuento');
            $facturaventa->SubTotal=$request->get('SubTotal');

            $mytime = Carbon::now('America/Managua');
            $facturaventa->Fecha_Realizacion = $mytime->toDateTimeString();
            $facturaventa->Fecha_Actualizacion = $mytime->toDateTimeString();
            $facturaventa->save();

            $producto = $request->get('ID_Producto');
            $cantidad = $request->get('Cantidad');
            $cont = 0;

            while($cont < count($producto)){
                $detalle = new FacturaVentaDetalle();
                $detalle->ID_Factura= $facturaventa->ID_Factura;
                $detalle->ID_Producto= $producto[$cont];
                $detalle->Cantidad= $cantidad[$cont];
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

    public function update(){

    }

    public function destroy(){

    }
}
