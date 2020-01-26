<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use App\Http\Requests\CargoFormRequest;

class CargoController extends Controller
{
    public function index(Request $request){
        return view('Nomina.Cargo.index') ->with('Cargo', Cargo::all());
    }

    public function create(Request $request){
        return view ('Nomina.Cargo.create');
    }

    public function store(Request $Request){
        $Cargo = new Cargo;
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->save();
        return redirect()->action('CargoController@index');
    }

    public function edit($ID){
        return view("Nomina.Cargo.edit ",["cargo"=>Cargo::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Cargo = Cargo::findOrFail($ID);
        $Cargo->Nombre_Cargo=$Request->input('Nombre_Cargo');
        $Cargo->Salario_Cargo=$Request->input('Salario_Cargo');
        $Cargo->update();
        return redirect()->action('CargoController@index');
    }
    public function destroy($ID){
        $Cargo=Cargo::findOrFail($ID);
        $Cargo->where('ID_Cargo',$ID)->delete();
        return route('Cargo.index', ['Eliminado' => true]);
    }
}
