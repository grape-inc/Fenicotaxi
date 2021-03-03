<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arqueo;
use App\Http\Requests\ArqueoFormRequest;
use DB;

class ArqueoController extends Controller
{
    public function index(Request $request)
    {
        $arqueo = DB::table('ArqueoCaja as a')
            ->join('Empleado as E', 'a.ID_Empleado', '=', 'E.ID_Empleado')
            ->select(
                'a.ID_Jornada',
                'a.Saldo_Inicial',
                'a.Saldo_Final',
                'E.Nombre_Empleado',
                'a.Fecha_Jornada',
                'a.Jornada_Abierta',
                'a.B10',
                'a.B20',
                'a.B50',
                'a.B100',
                'a.B200',
                'a.B500',
                'a.B1000',
                'a.M025',
                'a.M050',
                'a.M1',
                'a.M5',
                'a.Fecha_Actualizacion'
            )
            ->get();
        return view('Facturacion.Arqueo.index', ["arqueo" => $arqueo]);
    }

    public function create(Request $request)
    {
        $empleado = DB::table('Empleado')->get();
        $caja_abierta = Arqueo::where('Jornada_Abierta', true)->get();


        if ($caja_abierta->isEmpty()) {
            return view('Facturacion.Arqueo.create', ["empleado" => $empleado]);
        } else {
            flash('Ya existe un arqueo vigente, no puede crear otro arqueo sin cerrar el vigente')->error();
            return redirect()->action('ArqueoController@index');
        }
    }

    public function store(ArqueoFormRequest $Request)
    {
        $Arqueo = new Arqueo;
        $Arqueo->Saldo_Inicial = $Request->input('Saldo_Inicial');
        $Arqueo->ID_Empleado = $Request->input('ID_Empleado');
        $Arqueo->Fecha_Jornada = date('Y-m-d H:i:s');
        $Arqueo->Fecha_Caja = date('Y-m-d');
        $Arqueo->Jornada_Abierta = true;
        $Arqueo->Fecha_Actualizacion = date('Y-m-d H:i:s');
        $Arqueo->save();
        return redirect()->action('ArqueoController@index');
    }

    public function edit($ID)
    {
        $empleado = DB::table('Empleado')->get();
        $Arqueo = Arqueo::findOrFail($ID);
        $total_facturas_cordobas = $this->obtenerTotalFacturasCordobas($Arqueo->Fecha_Jornada);
        $total_facturas_dolares = $this->obtenerTotalFacturasDolares($Arqueo->Fecha_Jornada);

        if ($Arqueo->Jornada_Abierta == 0) {
            flash('El arqueo no puede ser editado, la jornada ya esta cerrada')->error();
            return redirect()->action('ArqueoController@index');
        } else {
            return view(
                "Facturacion.Arqueo.edit ",
                [
                    "arqueo" => $Arqueo,
                    "empleado" => $empleado,
                    "total_cordobas" => $total_facturas_cordobas,
                    "total_dolares" => $total_facturas_dolares,
                ]
            );
        }
    }

    public function update(ArqueoFormRequest $Request, $ID)
    {
        $empleado = DB::table('Empleado')->get();

        $Arqueo = Arqueo::findOrFail($ID);
        $Arqueo->Saldo_Inicial = $Request->input('Saldo_Inicial');
        $Arqueo->Saldo_Final = floatval($Request->input('Saldo_Final'));
        $Arqueo->Jornada_Abierta = 0;
        $Arqueo->B10 = $Request->input('B10');
        $Arqueo->B20 = $Request->input('B20');
        $Arqueo->B50 = $Request->input('B50');
        $Arqueo->B100 = $Request->input('B100');
        $Arqueo->B200 = $Request->input('B200');
        $Arqueo->B500 = $Request->input('B500');
        $Arqueo->B1000 = $Request->input('B1000');
        $Arqueo->M025 = $Request->input('M025');
        $Arqueo->M050 = $Request->input('M050');
        $Arqueo->M1 = $Request->input('M1');
        $Arqueo->M5 = $Request->input('M5');
        $Arqueo->Fecha_Actualizacion = date('Y-m-d H:i:s');

        $Arqueo->BD1 = $Request->input('BD1');
        $Arqueo->BD2 = $Request->input('BD2');
        $Arqueo->BD5 = $Request->input('BD5');
        $Arqueo->BD10 = $Request->input('BD10');
        $Arqueo->BD20 = $Request->input('BD20');
        $Arqueo->BD50 = $Request->input('BD50');
        $Arqueo->BD100 = $Request->input('BD100');
        $Arqueo->Saldo_Final_Dolar = $Request->input('Saldo_Final_Dolar');
        $Arqueo->Centavos_Dolar = $Request->input('Centavos_Dolares');
        $Arqueo->Centavos_Cordobas = $Request->input('Centavos_Cordobas');

        //Total de facturas por dia
        $total_facturas_cordobas = $this->obtenerTotalFacturasCordobas($Arqueo->Fecha_Jornada);
        $total_facturas_dolares = $this->obtenerTotalFacturasDolares($Arqueo->Fecha_Jornada);
        // Totales Arqueo
        $total_arqueo_cordobas = $this->calcularTotalArqueoCordobas($Arqueo);
        $total_arqueo_dolares = $this->calcularTotalArqueoDolares($Arqueo);

        if (($total_facturas_cordobas == $total_arqueo_cordobas && $total_arqueo_cordobas == $Arqueo->Saldo_Final) &&
            ($total_facturas_dolares == $total_arqueo_dolares && $total_arqueo_dolares == $Arqueo->Saldo_Final_Dolar)
        ) {

            $Arqueo->update();
            flash('Arqueo realizado correctamente')->success();
            return redirect()->action('ArqueoController@index');
        } else {
            $total_facturas_cordobas = $this->obtenerTotalFacturasCordobas($Arqueo->Fecha_Jornada);
            $total_facturas_dolares = $this->obtenerTotalFacturasDolares($Arqueo->Fecha_Jornada);
            flash('El total de arqueo no coincide con las facturas realizadas el dia de hoy, verifique los datos ingresados')->error();
            return view("Facturacion.Arqueo.edit ", [
                "arqueo" => $Arqueo,
                "empleado" => $empleado,
                "total_cordobas" => $total_facturas_cordobas,
                "total_dolares" => $total_facturas_dolares,
            ]);
        }
    }

    public function destroy($ID)
    {
        try {
            $Eliminado = true;
            $Arqueo = Arqueo::findOrFail($ID);
            if ($Arqueo->Jornada_Abierta == 0) {
                flash('El arqueo no puede ser eliminado, la jornada ya esta cerrada')->error();
                return route('Arqueo.index', ['Eliminado' => $Eliminado]);
                $Eliminado = false;
            } else {
                $Eliminado = true;
                $Arqueo->where('ID_Jornada', $ID)->delete();
            }
        } catch (\Exception $E) {
            $Eliminado = false;
        }

        return route('Arqueo.index', ['Eliminado' => $Eliminado]);
    }

    private function obtenerTotalFacturasCordobas($Fecha_Jornada)
    {
        $total_facturas_cordobas = round(floatval(DB::table('Factura_Venta as v')
            ->join('factura_venta_pago as fp', 'v.ID_Factura', '=', 'fp.factura_venta_id')
            ->where('v.Fecha_Realizacion', $Fecha_Jornada)
            ->where('v.Es_Credito', 0)
            ->where('fp.tipo_divisa_id', 2)
            ->sum('fp.monto')), 2);

        return $total_facturas_cordobas;
    }

    private function obtenerTotalFacturasDolares($Fecha_Jornada)
    {
        $total_facturas_dolares = round(floatval(DB::table('Factura_Venta as v')
            ->join('factura_venta_pago as fp', 'v.ID_Factura', '=', 'fp.factura_venta_id')
            ->where('v.Fecha_Realizacion', $Fecha_Jornada)
            ->where('v.Es_Credito', 0)
            ->where('fp.tipo_divisa_id', 1)
            ->sum('fp.monto')), 2);

        return $total_facturas_dolares;
    }

    private function calcularTotalArqueoCordobas($Arqueo)
    {

        $billetes_10 = $Arqueo->B10 * 10;
        $billetes_20 = $Arqueo->B20 * 20;
        $billetes_50 = $Arqueo->B50 * 50;
        $billetes_100 = $Arqueo->B100 * 100;
        $billetes_200 = $Arqueo->B200 * 200;
        $billetes_500 = $Arqueo->B500 * 500;
        $billetes_1000 = $Arqueo->B1000 * 1000;
        $moneda_025 = $Arqueo->M025 * 0.25;
        $moneda_050 = $Arqueo->M050 * 0.50;
        $moneda_1 = $Arqueo->M1 * 1;
        $moneda_5 = $Arqueo->M5 * 5;
        $centavos = $Arqueo->Centavos_Cordobas / 100;

        $cantidad = [
            $billetes_10, $billetes_20, $billetes_50, $billetes_100,
            $billetes_500, $billetes_200, $billetes_1000, $moneda_025,
            $moneda_050, $moneda_1, $moneda_5, $centavos
        ];

        $total_arqueo = array_sum($cantidad);
        return $total_arqueo;
    }

    private function calcularTotalArqueoDolares($Arqueo)
    {

        $billetes_1 = $Arqueo->BD1 * 1;
        $billetes_2 = $Arqueo->BD2 * 2;
        $billetes_5 = $Arqueo->BD5 * 5;
        $billetes_10 = $Arqueo->BD10 * 10;
        $billetes_20 = $Arqueo->BD20 * 20;
        $billetes_50 = $Arqueo->BD50 * 50;
        $billetes_100 = $Arqueo->BD100 * 100;
        $centavos = $Arqueo->Centavos_Dolar / 100;
        $cantidad = [
            $billetes_1, $billetes_2, $billetes_5, $billetes_10,
            $billetes_20, $billetes_50, $billetes_100, $centavos
        ];

        $total_arqueo_dolares = array_sum($cantidad);

        return $total_arqueo_dolares;
    }
}
