<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadMedida;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UnidadMedidaFormRequest;
use DB;

class UnidadesDeMedidaController extends Controller
{
    public function index(Request $request){
        return view('Inventario.UnidadesDeMedida.index') ->with('Unidad', UnidadMedida::all());
    }

    public function create(){
        return view ('Inventario.UnidadesDeMedida.create');
    }

    public function store(Request $Request){
        $Request->validate([            
            'Nombre_Unidad' => 'required|max:60'
        ]);
        $Unidad = new UnidadMedida();        
        $Unidad->Nombre_Unidad=$Request->get('Nombre_Unidad');
        $Unidad->save();
        return redirect()->action('UnidadesDeMedidaController@index');
    }

    public function edit($ID){
        return view("Inventario.UnidadesDeMedida.edit ",["Unidad"=>UnidadMedida::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Request->validate([            
            'Nombre_Unidad' => 'required|max:60'
        ]);
        $Unidad = UnidadMedida::findOrFail($ID);
        $Unidad->Nombre_Unidad=$Request->get('Nombre_Unidad');        
        $Unidad->update();    
        return redirect()->action('UnidadesDeMedidaController@index');
    }
    public function destroy($ID){
        $Unidad=UnidadMedida::findOrFail($ID);
        $Unidad->where('ID_Unidad',$ID)->delete();
        return route('UnidadesDeMedida.index', ['Eliminado' => true]);
    }
}
