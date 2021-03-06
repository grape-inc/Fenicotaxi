<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaProducto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaProductoFormRequest;
use DB;

class CategoriaProductoController extends Controller
{
    public function index(Request $request){
        return view('inventario.categorias.index') ->with('Categorias', CategoriaProducto::all());
    }

    public function create(){
        return view ('inventario.categorias.create');
    }

    public function store(CategoriaProductoFormRequest $Request){
        $Validacion = $Request->validated();
        $Categoria = new CategoriaProducto;
        $Categoria->Nombre_Categoria=$Request->get('Nombre_Categoria');
        $Categoria->Descripcion_Categoria=$Request->get('Descripcion_Categoria');
        $Categoria->save();
        return redirect()->action('CategoriaProductoController@index');
    }

    public function edit($ID){
        return view("Inventario.Categorias.edit",["Categoria"=>CategoriaProducto::findOrFail($ID)]);
    }

    public function update(CategoriaProductoFormRequest $Request, $ID){
        $Validacion = $Request->validated();
        $Categoria = CategoriaProducto::findOrFail($ID);
        $Categoria->Nombre_Categoria=$Request->get('Nombre_Categoria');
        $Categoria->Descripcion_Categoria=$Request->get('Descripcion_Categoria');
        $Categoria->update();
        return redirect()->action('CategoriaProductoController@index');
    }
    public function destroy($ID){
        $Eliminado = true;
        try {
            $Categorias=CategoriaProducto::findOrFail($ID);
            $Categorias->where('ID_Categoria',$ID)->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('Categorias.index', ['Eliminado' => $Eliminado]);
    }
}
