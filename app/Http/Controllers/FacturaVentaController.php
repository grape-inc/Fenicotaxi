<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacturaVenta;
use App\FacturaVentaDetalle;
use DB;
use Illuminate\Support\Carbon;
class FacturaVentaController extends Controller
{
    public function index(){
        $facturaventa= DB::table('Factura_Venta as v')
        ->join('Cliente as c','v.ID_Cliente','=','c.ID_Cliente')
        ->join('Divisa as d','v.ID_Divisa','=','d.ID_Divisa')
        ->join('Empleado as e','v.ID_Empleado','=','e.ID_Empleado')
        ->join('Factura_Venta_Detalle as fd','v.ID_Factura','=','fd.ID_Factura')
        ->select('v.ID_Factura','v.Codigo_Factura','v.Es_Credito','v.Descuento','v.Total_Facturado','e.Nombre_Empleado'
        ,'v.Fecha_Realizacion','v.Fecha_Actualizacion','c.Nombre_Cliente','v.ID_Jornada','v.Monto_Restante','d.Nombre_Divisa')
        ->get();
        return view('Facturacion.Venta.index',["facturaventa"=>$facturaventa]);
    }

    public function create(){
        $empleado = DB::table('Empleado')->get();
        $cliente = DB::table('Cliente')->get();
        $divisa = DB::table('Divisa')->get();
        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();
        return view('Facturacion.Venta.Create',["empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa]);
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

           return redirect()->action('FacturaVentaController@index');

    }

    public function valoresCalculo( ){
        echo "im in AjaxController index";
    }

    public function update(){

    }

    public function destroy(){

    }
}
