<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InformeDeCierre;
use App\Http\Requests\InformeDeCierreFormRequest;
use DB;
use App\Divisa;

class InformeDeCierreController extends Controller
{
    public function index(Request $request)
    {
        $arqueo = DB::table('ArqueoCaja as a')
            ->join('Factura_Venta as fv', 'fv.ID_Jornada', '=', 'a.ID_Jornada')
            ->join('Cliente as cl', 'cl.ID_Cliente', '=', 'fv.ID_Cliente')
            ->join('Empleado as e', 'fv.ID_Empleado', '=', 'e.ID_Empleado')
            ->select(
                'a.ID_Jornada',
                'a.Fecha_Jornada',
                'a.Jornada_Abierta',
                'a.ID_empleado',
                'e.Nombre_Empleado as Cierre_Asignado',
                'a.Saldo_Inicial',
                'a.Saldo_Final',
                'fv.Fecha_Realizacion',
                'fv.Codigo_Factura',
                'cl.Nombre_Cliente as Nombre' ,
                'cl.Apellido_Cliente as Apellido',
                'fv.Es_Credito',
                'fv.ID_Divisa',
                'fv.total_facturado',
                'fv.ID_Empleado as Vendedor',
                'fv.ID_Jornada as ID_DE_ARQUEO',
                'e.Nombre_Empleado',
                'a.Fecha_Actualizacion'
            )
            ->orderBy('a.ID_Jornada')
            ->get();
        return view('Facturacion.InformeDeCierre.index', ["arqueo" => $arqueo]);
    }

}
