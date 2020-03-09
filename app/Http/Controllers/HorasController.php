<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horas;
use App\Empleado;
use App\Http\Requests\ClientesFormRequest;
use Illuminate\Support\Facades\Redirect;
use DB;

class HorasController extends Controller
{
    public function index(){
        $Horas = DB::table('Empleado_Hora_Laborada')
            ->join('Empleado', 'Empleado.ID_Empleado', '=', 'Empleado_Hora_Laborada.ID_Empleado')
            ->get();
        return view('nomina.Horas.index') ->with('Horas', $Horas);
    }

    public function create(Request $Request){
        $Empleado=  Empleado::all();
        return view ('nomina.Horas.create',[
            'Empleados' => $Empleado,
        ]);
    }

    public function edit(Request $Request,$ID){
        $Empleado=  Empleado::all();
        $Horas = Horas::where('ID_Empleado','=',$ID)
                 ->where('Fecha_Registro','=',$Request->Fecha_Registro)->get()->first();
        return view ('nomina.Horas.edit',[
            'Empleado' => $Empleado,
            'Horas' => $Horas,
        ]);
    }

    public function store(Request $Request){
        $Request->validate([
            'ID_Empleado' => 'required',
            'Fecha_Registro' => 'required',
            'Horas_Laboradas' => 'required'
        ]);
        try {
            $Horas = new Horas();
            $Horas->ID_Empleado=$Request->get('ID_Empleado');
            $Horas->Fecha_Registro=$Request->get('Fecha_Registro');
            $Horas->Horas_Laboradas=$Request->get('Horas_Laboradas');
            $Horas->save();
        } catch (\Exception $E) {
            flash('Ya existe un registro de horas asociado a este empleado en este dia.')->error();
            return redirect()->back();
        }
        return redirect()->action('HorasController@index');
    }

    public function update(Request $Request, $ID){
        $Horas= Horas::where('ID_Empleado','=',$ID)
               ->where('Fecha_Registro','=',$Request->Fecha_Registro)
               ->update(['Horas_Laboradas'=>$Request->get('Horas_Laboradas')]);;
        return redirect()->action('HorasController@index');
    }
}
