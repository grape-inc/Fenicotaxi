<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arqueo;
use DB;

class ArqueoController extends Controller
{
    public function index(Request $request){
        $arqueo= DB::table('ArqueoCaja as a')
        ->join('Empleado as E','a.ID_Empleado','=','E.ID_Empleado')
        ->select('a.ID_Jornada','a.Saldo_Inicial','a.Saldo_Final','E.Nombre_Empleado','a.Fecha_Jornada','a.Jornada_Abierta',
                'a.B10','a.B20','a.B50','a.B100','a.B200','a.B500','a.M025','a.M050','a.M1','a.M5','a.Fecha_Actualizacion')
        ->get();;
        return view('Facturacion.Arqueo.index',["arqueo"=>$arqueo]);
    }

    public function create(Request $request){
        return view ('Facturacion.Arqueo.create');
    }

    public function store(Request $Request){
        $Cargo = new Arqueo;
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->save();
        return redirect()->action('ArqueoController@index');
    }

    public function edit($ID){
        return view("Facturacion.Arqueo.edit ",["arqueo"=>Arqueo::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Cargo = Arqueo::findOrFail($ID);
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->update();
        return redirect()->action('ArqueoController@index');
    }
    public function destroy($ID){
        $Cargo=Arqueo::findOrFail($ID);
        $Cargo->where('ID_Cargo',$ID)->delete();
        return route('Arqueo.index', ['Eliminado' => true]);
    }
}
