<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacturaVenta;
use App\FacturaVentaDetalle;
use App\Cliente;
use App\Empleado;
use App\Arqueo;
use DB;
use App\Http\Requests\FacturaFormRequest;
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
        $CodigoFactura = DB::table('Factura_Venta')
        ->select(DB::raw("COALESCE(max(codigo_factura),0) as CodigoFactura"))
        ->get();

        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();

        $fecha_hoy = date('Y-m-d');;
        $jornada = DB::table('ArqueoCaja')
        ->where('Fecha_Caja','=',$fecha_hoy,'AND','Jornada_Abierta','=','1')
        ->get();
        $as = count($jornada);

        if ( $as == 1){
            return view('Facturacion.Venta.create',["empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa,"CF"=>$CodigoFactura]);
        }else{
            flash('Necesita abrir caja para poder facturar')->error();
            return redirect()->action('FacturaVentaController@index');
        }

    }
    public function store(FacturaFormRequest $request){
        try {
            $request->validate([
                'ID_Cliente' => 'required',
                'Codigo_Factura' => 'required|numeric',
                'ID_Divisa' => 'required',
                'ID_Empleado' => 'required',
                'Descuento' => 'required',
                'ID_Producto' => 'required',
                'Cantidad' => 'required',
                'Precio' => 'required',
                'Total_Facturado' => 'required|numeric|min:0'
            ]);
            $CodigoFactura = FacturaVenta::where("Codigo_Factura", $request->get('Codigo_Factura'))->get();

            if(count($CodigoFactura) > 0 ){
                flash('El numero de factura ya existe.')->error();
                return redirect()->back()->withInput($request->input());
            }
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
            $facturaventa->Total_Facturado=$request->get('Total_Facturado');
            $facturaventa->ID_Empleado=$request->get('ID_Empleado');
            $facturaventa->ID_Cliente=$request->get('ID_Cliente');
            $facturaventa->ID_Divisa=$request->get('ID_Divisa');

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

           }
           catch(\Exception $e)
           {
              DB::rollback();
           }

           return redirect()->action('FacturaVentaController@index');

    }

    public function edit($id){
        $Factura = FacturaVenta::find($id);
        $empleado = DB::table('Empleado')->get();
        $cliente = DB::table('Cliente')->get();
        $divisa = DB::table('Divisa')->get();
        $Detalle = FacturaVenta::where('ID_Factura', $id);
        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();
        return view('Facturacion.Venta.edit',["Factura"=> $Factura,"empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa,"Detalle"=> $Detalle]);
    }

    public function update(){

    }

    public function destroy($id){
        $Eliminado = true;
        try {
            DB::table('Factura_Venta_Detalle')->where('ID_Factura', $id)->delete();
            $Factura=FacturaVenta::findOrFail($id);
            $Factura->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Venta.index', ['Eliminado' => $Eliminado]);
    }

    public function ajax_factura(){
        $Clientes =  DB::table('Cliente')->select('ID_Cliente', 'Nombre_Cliente',"Apellido_Cliente")->get();
        $Empleados = DB::table('Empleado')->select('ID_Empleado', 'Nombre_Empleado',"Apellido_Empleado")->get();
        return response()->json([
            'Clientes' => $Clientes,
            'Empleados' => $Empleados
        ]);
    }
}
