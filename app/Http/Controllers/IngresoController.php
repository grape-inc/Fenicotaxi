<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresosFormRequest;
use Illuminate\Http\Request;
use DB;
use App\Ingreso;
use App\IngresoDetalle;

class IngresoController extends Controller
{
    public function index(){
        $ingresos = DB::table('Ingreso as i')
        ->join('Proveedor as p','i.ID_Proveedor','=','p.ID_Proveedor')
        ->join('Empleado as e','i.ID_Empleado','=','e.ID_Empleado')
        ->join('Divisa as d','i.ID_Divisa','=','d.ID_Divisa')
        ->select('i.ID_Ingreso','i.Impuesto','i.Total','i.Fecha_Realizacion','i.Codigo_Ingreso','p.Nombre_Proveedor','e.Nombre_Empleado','d.Nombre_Divisa','d.Simbolo_Divisa')
        ->get();
        return view('inventario.Ingresos.index',["ingresos"=>$ingresos]);
    }

    public function create(){
        $empleado = DB::table('Empleado')->get();
        $proveedor = DB::table('Proveedor')->get();
        $divisa = DB::table('Divisa')->get();
        $tasa_Cambio = $divisa[0]->Equivalencia_Cordoba;
        $producto = DB::table('Producto as prod')
        ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'),'prod.ID_Producto')
        ->where('prod.Existencias_Minimas','>','0')
        ->get();
        return view('inventario.Ingresos.create',["empleado"=>$empleado,"producto"=>$producto,"proveedor"=>$proveedor,"divisa" =>$divisa,'tasa_Cambio'=>$tasa_Cambio]);
    }

    public function store(IngresosFormRequest $request){
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
           $ingreso->ID_Divisa = $request->get('ID_Divisa');
           $ingreso->save();

            $producto = $request->get('ID_Producto');
            $cantidad = $request->get('Cantidad');
            $precio = $request->get('Precio');
            $cont = 0;

            while($cont < count($producto)){
                $detalle = new IngresoDetalle();
                $detalle->ID_Ingreso = $ingreso->ID_Ingreso;
                $detalle->ID_Producto = $producto[$cont];
                $detalle->Cantidad = $cantidad[$cont];
                $detalle->Precio = $precio[$cont];
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
