<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresosFormRequest;
use Illuminate\Http\Request;
use DB;
use App\Ingreso;
use App\IngresoDetalle;
use Illuminate\Support\Facades\Log;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = DB::table('Ingreso as i')
            ->join('Proveedor as p', 'i.ID_Proveedor', '=', 'p.ID_Proveedor')
            ->join('Empleado as e', 'i.ID_Empleado', '=', 'e.ID_Empleado')
            ->join('Divisa as d', 'i.ID_Divisa', '=', 'd.ID_Divisa')
            ->select('i.ID_Ingreso', 'i.Impuesto', 'i.Total', 'i.Fecha_Realizacion', 'i.Codigo_Ingreso', 'p.Nombre_Proveedor', 'e.Nombre_Empleado', 'd.Nombre_Divisa', 'd.Simbolo_Divisa')
            ->get();
        return view('inventario.Ingresos.index', ["ingresos" => $ingresos]);
    }

    public function create()
    {
        $empleado = DB::table('Empleado')->get();
        $proveedor = DB::table('Proveedor')->get();
        $divisa = DB::table('Divisa')->get();
        $tasa_Cambio = $divisa[0]->Equivalencia_Cordoba;
        $producto = DB::table('Producto as prod')
            ->select(DB::Raw('CONCAT(prod.Cod_Producto," / ",prod.Nombre_Producto) as producto'), 'prod.ID_Producto')
            ->where('prod.Existencias_Minimas', '>', '0')
            ->get();
        return view('inventario.Ingresos.create', ["empleado" => $empleado, "producto" => $producto, "proveedor" => $proveedor, "divisa" => $divisa, 'tasa_Cambio' => $tasa_Cambio]);
    }

    public function store(IngresosFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'ID_Proveedor' => 'required',
                'ID_Empleado' => 'required',
                'Impuesto' => 'required|numeric',
                'Total' => 'required|numeric',
                'Codigo_Ingreso' => 'required|numeric',
            ]);
            $ingreso = new Ingreso;
            $ingreso->ID_Proveedor = $request->get('ID_Proveedor');
            $ingreso->ID_Empleado = $request->get('ID_Empleado');
            $ingreso->Fecha_Realizacion = date('Y-m-d H:i:s');
            $ingreso->Impuesto = $request->get('Impuesto');
            $ingreso->Total = $request->get('Total');
            $ingreso->Codigo_Ingreso = $request->get('Codigo_Ingreso');
            $ingreso->ID_Divisa = $request->get('ID_Divisa');
            $ingreso->save();

            $producto = $request->get('ID_Producto');
            $cantidad = $request->get('Cantidad');
            $precio = $request->get('Precio');
            $cont = 0;

            while ($cont < count($producto)) {
                $detalle = new IngresoDetalle();
                $detalle->ID_Ingreso = $ingreso->ID_Ingreso;
                $detalle->ID_Producto = $producto[$cont];
                $detalle->Cantidad = $cantidad[$cont];
                $detalle->Precio = $precio[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->action('IngresoController@index');
    }

    public function edit($id)
    {
        $Ingreso = Ingreso::find($id);
        $empleado = DB::table('Empleado')->get();
        $proveedor = DB::table('Proveedor')->get();
        $divisa = DB::table('Divisa')->get();
        $ingreso_detalle = DB::table('ingreso_detalle as in')
            ->join('ingreso as ino', 'in.ID_Ingreso', '=', 'ino.ID_Ingreso')
            ->join('Producto as P', 'in.ID_Producto', '=', 'P.ID_Producto')
            ->join('divisa as di', 'ino.ID_Divisa', '=', 'di.ID_Divisa')
            ->where('in.ID_Ingreso', $id)->get();
        return view('inventario.Ingresos.edit', ["Ingreso" => $Ingreso, "empleado" => $empleado, "divisa" => $divisa, "Proveedor" => $proveedor, "Detalle" => $ingreso_detalle]);
    }
}
