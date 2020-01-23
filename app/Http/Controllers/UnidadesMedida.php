<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadMedida;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UnidadMedidaFormRequest;
use DB;

class UnidadesMedida extends Controller
{
    public function index(Request $request){
        return view('Inventario.UnidadesMedida.index') ->with('Unidad', UnidadMedida::all());
    }

    public function create(){
        return view ('Inventario.UnidadesDeMedida.create');
    }

    public function store(UnidadMedidaFormRequest $Request){
        $Validacion = $Request->validated();
        $Unidad = new UnidadMedida();
        $Unidad->Nombre_Unidad=$Request->get('Nombre_Unidad');        
        $Unidad->save();
        return redirect()->action('UnidadesDeMedidaController@index');
    }

    public function edit($ID){
        return view("Inventario.UnidadesDeMedida.edit ",["Unidad"=>UnidadMedida::findOrFail($ID)]);
    }

    public function update(CategoriaProductoFormRequest $Request, $ID){
        $Validacion = $Request->validated();
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
