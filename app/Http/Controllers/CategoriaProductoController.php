<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaProducto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaProductoFormRequest;
use DB;

class CategoriaProductoController extends Controller
{
    public function __construct()
    {
            
    }

    public function index(Request $request){                        
        return view('inventario.categorias.index') ->with('Categorias', CategoriaProducto::all());               
    }

    public function create(){
        return view ('inventario.categorias.create');
    }

    public function store(CategoriaProductoFormRequest $request){
        $categorias = new CategoriaProducto;
        $categorias->Nombre_Categoria=$request->get('Nombre_Categoria');
        $categorias->Descripcion_Categoria=$request->get('Descripcion_Categoria');
        $categorias->save();
        return Redirect::to('inventario/categorias');
    }

    public function show($id){
        return view("inventario.categorias.show",["categoria"=>CategoriaProducto::findOrFail($id)]);
    }

    public function edit($id){
        return view("inventario.categorias.edit",["categoria"=>CategoriaProducto::findOrFail($id)]);
    }
    public function update(CategoriaProductoFormRequest $request, $id){
        $categorias = CategoriaProducto::findOrFail($id);
        $categorias->Nombre_Categoria=$request->get('Nombre_Categoria');
        $categorias->Descripcion_Categoria=$request->get('Descripcion_Categoria');
        $categorias->update();
        return Redirect::to('inventario/categorias');
    }
    public function destroy($id){
        $categorias= CategoriaProducto::findOrFail($id);
        $categorias->where('ID_Categoria'.$id)->delete();
        return Redirect::to('inventario/categorias');
    }
}
