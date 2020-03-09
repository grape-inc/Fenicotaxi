<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use App\Http\Requests\CargoFormRequest;

class CargoController extends Controller
{
    public function index(Request $request){
        return view('nomina.cargo.index') ->with('Cargo', Cargo::all());
    }

    public function create(Request $request){
        return view ('nomina.cargo.create');
    }

    public function store(CargoFormRequest $Request){
        $Cargo = new Cargo;
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->save();
        return redirect()->action('CargoController@index');
    }

    public function edit($ID){
        return view("nomina.cargo.edit ",["cargo"=>Cargo::findOrFail($ID)]);
    }

    public function update(CargoFormRequest $Request, $ID){
        $Cargo = Cargo::findOrFail($ID);
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->update();
        return redirect()->action('CargoController@index');
    }
    public function destroy($ID){
        $Eliminado = true;
        try {
            $Cargo=Cargo::findOrFail($ID);
            $Cargo->where('ID_Cargo',$ID)->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Cargo.index', ['Eliminado' => $Eliminado]);
    }
}
