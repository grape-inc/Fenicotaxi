<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arqueo;
use App\Http\Requests\ArqueoFormRequest;
use DB;

class ArqueoController extends Controller
{
    public function index(Request $request){
        $arqueo= DB::table('ArqueoCaja as a')
        ->join('Empleado as E','a.ID_Empleado','=','E.ID_Empleado')
        ->select('a.ID_Jornada','a.Saldo_Inicial','a.Saldo_Final','E.Nombre_Empleado','a.Fecha_Jornada','a.Jornada_Abierta',
                'a.B10','a.B20','a.B50','a.B100','a.B200','a.B500','a.B1000','a.M025','a.M050','a.M1','a.M5','a.Fecha_Actualizacion')
        ->get();
        return view('Facturacion.Arqueo.index',["arqueo"=>$arqueo]);
    }

    public function create(Request $request){
        $empleado = DB::table('Empleado')->get();
        return view ('Facturacion.Arqueo.create',["empleado"=>$empleado]);
    }

    public function store(ArqueoFormRequest $Request){
        $Arqueo = new Arqueo;
        $Arqueo->Saldo_Inicial=$Request->input('Saldo_Inicial');
        $Arqueo->ID_Empleado=$Request->input('ID_Empleado');
        $Arqueo->Fecha_Jornada= date('Y-m-d H:i:s');
        $Arqueo->Fecha_Caja = date('Y-m-d');
        $Arqueo->Jornada_Abierta= true;
        $Arqueo->Fecha_Actualizacion= date('Y-m-d H:i:s');
        $Arqueo->save();
        return redirect()->action('ArqueoController@index');
    }

    public function edit($ID){
        $empleado = DB::table('Empleado')->get();
        return view("Facturacion.Arqueo.edit ",["arqueo"=>Arqueo::findOrFail($ID),"empleado"=>$empleado]);
    }

    public function update(ArqueoFormRequest $Request, $ID){
        $Arqueo = Arqueo::findOrFail($ID);
        $Arqueo->Saldo_Inicial=$Request->input('Saldo_Inicial');
        $Arqueo->Saldo_Final=$Request->input('Saldo_Final');
        $Arqueo->Jornada_Abierta=0;
        $Arqueo->B10=$Request->input('B10');
        $Arqueo->B20=$Request->input('B20');
        $Arqueo->B50=$Request->input('B50');
        $Arqueo->B100=$Request->input('B100');
        $Arqueo->B500=$Request->input('B500');
        $Arqueo->B1000=$Request->input('B1000');
        $Arqueo->M025=$Request->input('M025');
        $Arqueo->M050=$Request->input('M050');
        $Arqueo->M1=$Request->input('M1');
        $Arqueo->M5=$Request->input('M5');
        $Arqueo->Fecha_Actualizacion= date('Y-m-d H:i:s');
        $Arqueo->update();
        return redirect()->action('ArqueoController@index');
    }
    public function destroy($ID){
        $Eliminado = true;
        try {
            $Arqueo=Arqueo::findOrFail($ID);
            $Arqueo->where('ID_Jornada',$ID)->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Arqueo.index', ['Eliminado' => $Eliminado]);
    }
}
