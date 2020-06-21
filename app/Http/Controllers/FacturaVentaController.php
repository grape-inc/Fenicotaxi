<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacturaVenta;
use App\FacturaVentaDetalle;
use App\FacturaVentaPago;
use App\Cliente;
use App\Empleado;
use App\Arqueo;
use App\Producto;
use App\Divisa;
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
        ->select('v.ID_Factura','v.Codigo_Factura','v.Es_Credito','v.Descuento','v.Total_Facturado','e.Nombre_Empleado'
        ,'v.Fecha_Realizacion','v.Fecha_Actualizacion','c.Nombre_Cliente','v.ID_Jornada','v.Monto_Restante','d.Nombre_Divisa','d.Simbolo_Divisa')
        ->get();
        return view('Facturacion.Venta.index',["facturaventa"=>$facturaventa]);
    }

    public function create(){
        $empleado = DB::table('Empleado')->get();
        $cliente = DB::table('Cliente')->get();
        $divisa = DB::table('Divisa')->get();
        $pagos = DB::table('tipo_pago')->get();
        $tasa_Cambio = $divisa[0]->Equivalencia_Cordoba;
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
            return view('Facturacion.Venta.create',["empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa,"CF"=>$CodigoFactura, 'pagos'=>$pagos,'tasa_Cambio'=>$tasa_Cambio]);
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

            $facturaventa->Es_Credito= $request->get('Es_Credito');
            if ($request->get('Es_Credito') == "on"){
                $facturaventa->Es_Credito=true;
            }
            else {
                $facturaventa->Es_Credito=false;
            }
            $facturaventa->Descuento=$request->get('Descuento');
            $facturaventa->SubTotal=$request->get('SubTotal');
            $facturaventa->Total_Facturado=$request->get('Total_Facturado');
            $facturaventa->ID_Empleado=$request->get('ID_Empleado');
            $facturaventa->ID_Cliente=$request->get('ID_Cliente');
            $facturaventa->ID_Divisa=$request->get('ID_Divisa');
            $facturaventa->IVA=$request->get('IVA');
            $facturaventa->Observacion=$request->get('Descripcion_Factura');
            $mytime = Carbon::now('America/Managua');
            $facturaventa->Fecha_Realizacion = $mytime->toDateTimeString();
            $facturaventa->Fecha_Actualizacion = $mytime->toDateTimeString();
            $facturaventa->save();

            $producto = $request->get('ID_Producto');
            $cantidad = $request->get('Cantidad');
            $precio = $request->get('Precio');
            $descripcion = $request->get('Descripcion');
            $cont = 0;
            while($cont < count($producto)){
                $detalle = new FacturaVentaDetalle();
                $detalle->ID_Factura= $facturaventa->ID_Factura;
                $detalle->ID_Producto= $producto[$cont];
                $detalle->Cantidad= $cantidad[$cont];
                $detalle->Precio= $precio[$cont];
                $detalle->Observacion= $descripcion[$cont];
                $producto_existencia = Producto::findOrFail($producto[$cont]);
                $existencia_producto = $producto_existencia->Existencias - $cantidad[$cont];
                if ($existencia_producto < 0)
                {
                    flash('No existen suficientes existencias del producto : '.$producto_existencia->Nombre_Producto)->error();
                    return redirect()->back()->withInput($request->input());
                }
                $detalle->save();
                $cont=$cont+1;
            }
            if ($facturaventa->Es_Credito == false){
                $tipo_pago = $request->get('ID_Pago_Factura');
                $moneda_pago = $request->get('ID_Divisa_Pago');
                $monto_pago = $request->get('Monto');
                $cont = 0;
                while($cont < count($tipo_pago)){
                    $detalle = new FacturaVentaPago();
                    $detalle->factura_venta_id= $facturaventa->ID_Factura;
                    $detalle->tipo_pago_id= $tipo_pago[$cont];
                    $detalle->tipo_divisa_id= $moneda_pago[$cont];
                    $detalle->monto= $monto_pago[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }
            }
            DB::commit();

           }
           catch(\Exception $e)
           {
               dd($e);
              DB::rollback();
           }
           return redirect()->action('FacturaVentaController@index', ["ID"=>$facturaventa->ID_Factura]);

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
        $FacturaDetalle = DB::table('Factura_Venta_Detalle as FV')
        ->join('Producto as P','FV.ID_Producto','=','P.ID_Producto')
        ->where('FV.ID_Factura',$id)->get();
        $FacturaPago = DB::table('factura_venta_pago as fp')
        ->join('tipo_pago as tp','fp.tipo_pago_id','=','tp.ID')
        ->join('divisa as d','fp.tipo_divisa_id','=','d.ID_Divisa')
        ->where('fp.factura_venta_id',$id)->get();
        return view('Facturacion.Venta.edit',["Factura"=> $Factura,"empleado"=>$empleado,"producto"=>$producto,"cliente"=>$cliente,"divisa" =>$divisa,"Detalle"=> $Detalle,"FacturaVentaDetalle"=>$FacturaDetalle,'FacturaPago'=>$FacturaPago]);
    }

    public function destroy($id){
        $Eliminado = true;
        try {
            DB::table('Factura_Venta_Detalle')->where('ID_Factura', $id)->delete();
            DB::table('factura_venta_pago')->where('factura_venta_id', $id)->delete();
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

    public function pdf_factura(Request $request) {
        $Factura =FacturaVenta::find($request->id);
        $Cliente = Cliente::find($Factura->ID_Cliente);
        $FacturaDetalle =FacturaVentaDetalle::where('ID_Factura', $request->id)->get();
        if($Factura->Es_Credito == 1) {
            $Contado = "checked";
            $Credito = "";
        }
        else{
            $Credito = "checked";
            $Contado = "";
        }
        $Datos =
        [
        'Numero' => $Factura->Codigo_Factura,
        'NombreCliente' => $Cliente->Nombre_Cliente.' '.$Cliente->Apellido_Cliente,
        'Fecha' =>  \Carbon\Carbon::parse($Factura->Fecha_Realizacion)->format('d/m/y'),
        'Direccion' => $Cliente->Direccion,
        'Contado' => $Contado,
        'Credito' => $Credito,
        'FacturaDetalle' => $FacturaDetalle,
        'Observacion' => $Factura->Observacion,
        'Subtotal' => $Factura->SubTotal.' '.Divisa::find($Factura->ID_Divisa)->Simbolo_Divisa,
        'IVA' => $Factura->IVA.' '.Divisa::find($Factura->ID_Divisa)->Simbolo_Divisa,
        'Total' => $Factura->Total_Facturado.' '.Divisa::find($Factura->ID_Divisa)->Simbolo_Divisa,
        ];

        $pdf = \PDF::loadView('factura', $Datos);

        return $pdf->download('Factura.pdf');
    }
}
