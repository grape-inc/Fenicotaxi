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
        $Horas = DB::table('empleado_hora_laborada')
            ->join('empleado', 'empleado.ID_Empleado', '=', 'empleado_hora_laborada.ID_Empleado')
            ->get();
        return view('Nomina.Horas.index') ->with('Horas', $Horas);
    }

    public function create(Request $Request){
        $Empleado=  Empleado::all();
        return view ('Nomina.Horas.create',[
            'Empleados' => $Empleado,
        ]);
    }
    
    public function edit(Request $Request,$ID){
        $Empleado=  Empleado::all();
        $Horas = Horas::where('ID_Empleado','=',$ID)
                 ->where('Fecha_Registro','=',$Request->Fecha_Registro)->get()->first();
        return view ('Nomina.Horas.edit',[
            'Empleado' => $Empleado,
            'Horas' => $Horas,
        ]);
    }

    public function store(Request $Request){
        $Horas = new Horas();
        $Horas->ID_Empleado=$Request->get('ID_Empleado');
        $Horas->Fecha_Registro=$Request->get('Fecha_Registro');
        $Horas->Horas_Laboradas=$Request->get('Horas_Laboradas');
        $Horas->save();
        return redirect()->action('HorasController@index');
    }

    public function update(Request $Request, $ID){
        $Horas= Horas::where('ID_Empleado','=',$ID)
               ->where('Fecha_Registro','=',$Request->Fecha_Registro)->get()->first();
        $Horas->Horas_Laboradas=$Request->get('Horas_Laboradas');
        $Horas->update();
        return redirect()->action('HorasController@index');
    }
}
