<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomina;
use App\NominaDetalle;
use App\Horas;
use App\Cargo;
use App\Empleado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use DB;

class NominaController extends Controller
{
    public function index(Request $Request){
        return view('nomina.Nomina.index') ->with('Nomina', Nomina::all());
    }

    public function edit($ID){
        $Nomina =  Nomina::findOrFail($ID);
        $Detalle = NominaDetalle::find($ID)->get();
        $Detalle= DB::table('NominaDetalle AS ND')
        ->join('Empleado AS E','ND.ID_Empleado','=','E.ID_Empleado')
        ->get();
        $TotalINSS = DB::table('NominaDetalle AS ND')
        ->where("ID_Nomina",$ID)
        ->sum("INSS_Laboral");
        return view ('nomina.Nomina.edit',[
            'Nomina' => $Nomina,
            'Detalle' => $Detalle,
            'INSS_SUMA' => $TotalINSS
        ]);
    }

    public function create(Request $Request){
        $Empleado= DB::table('Empleado AS E')
        ->join('Cargo AS C','E.ID_Cargo','=','C.ID_Cargo')
        ->get();
        return view ('nomina.Nomina.create',[
            'Empleados' => $Empleado
        ]);
    }

    public function store(Request $Request){
        setlocale(LC_ALL, 'es_NI', 'ni', 'ES');
        $Now = Carbon::now();
        $Empleados = $Request->get('ID_Empleado');
        $Salarios = $Request->get('Salario');
        $Horas = $Request->get('Horas');
        try {
            DB::beginTransaction();
            $Nomina=new Nomina();
            $Nomina->Año_Nomina=$Now->year;
            $Nomina->Mes_Nomina=$Now->formatLocalized('%B');
            $Nomina->Fecha_Generado=$Now;
            $Nomina->Empleado_Genero= session('ID_Empleado');
            $Nomina->save();
            $ContadorEmpleado = 0;
            $Total_Bruto = 0;
            $Total_Deducciones = 0;
            $Total_Nomina = 0;
            while($ContadorEmpleado < count($Empleados))
            {
                $SalarioBrutoEmpleado = $Salarios[$ContadorEmpleado];
                $HorasLaboradas = $Horas[$ContadorEmpleado];
                $SalarioNeto = (($SalarioBrutoEmpleado / 160)) * $HorasLaboradas;
                $InssLaboral = $SalarioNeto * 0.07;
                $IR = NominaController::CalcularIR($SalarioBrutoEmpleado);
                $Detalle = new NominaDetalle();
                $Detalle->ID_Nomina = $Nomina->ID_Nomina;
                $Detalle->ID_Empleado = $Empleados[$ContadorEmpleado];
                $Detalle->Salario_Bruto = $SalarioBrutoEmpleado;
                $Detalle->INSS_Laboral = $InssLaboral;
                $Detalle->IR_Laboral = $IR;
                $Detalle->Total_Neto = $SalarioNeto - $InssLaboral - $IR;
                $Detalle->Horas_Laboradas = $HorasLaboradas;
                $Detalle->save();
                $Total_Bruto = $Total_Bruto + $SalarioBrutoEmpleado;
                $Total_Deducciones = $Total_Deducciones + $InssLaboral + $IR;
                $Total_Nomina = $Total_Nomina + ($SalarioNeto - $InssLaboral - $IR);
                $ContadorEmpleado=$ContadorEmpleado + 1;
            }
            $Nomina->Total_Bruto= $Total_Bruto;
            $Nomina->Total_Deducciones= $Total_Deducciones;
            $Nomina->Total_Nomina= $Total_Nomina;
            $Nomina->update();
            DB::commit();
           }
           catch(\Exception $E)
           {
              DB::rollback();
              flash('No se puede general la nomina, porque ya existe una generada en este mes.')->error();
              return redirect()->back();
           }
           return redirect()->action('NominaController@index');
    }

    public function destroy($ID){
        $Eliminado = true;
        try {
            # Borrando detalles de la nomina
            $NominaDetalle=NominaDetalle::findOrFail($ID);
            $NominaDetalle->where('ID_Nomina',$ID)->delete();

            # Borrando la nomina
            $Nomina=Nomina::findOrFail($ID);
            $Nomina->where('ID_Nomina',$ID)->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Nomina.index', ['Eliminado' => $Eliminado]);
    }

    public function CalcularIR($SalarioNeto)
    {
        $SalarioAnual = $SalarioNeto * 12;
        if ($SalarioAnual <= 100000) {
            $DeduccionIR = 0;
        }
        else if ($SalarioAnual >= 100000 && $SalarioAnual <= 200000) {
            $DeduccionIR = ($SalarioNeto * 0.15);
        }
        else if ($SalarioAnual >= 200000 && $SalarioAnual <= 350000) {
            $DeduccionIR = ($SalarioNeto * 0.2);
        }
        else if ($SalarioAnual >= 350000 && $SalarioAnual <= 500000) {
            $DeduccionIR = ($SalarioNeto * 0.25);
        }
        else {
            $DeduccionIR = ($SalarioNeto * 0.3);
        }
        return $DeduccionIR;
    }
}
