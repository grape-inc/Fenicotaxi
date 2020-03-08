<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index(){
        return view('Nomina.Rol.index') ->with('Roles',Rol::all());
    }

    public function create(Request $request){
        return view('Nomina.Rol.create');
    }

    public function store(Request $request){
        $roles = new Rol();
        $roles->Nombre_Rol = $request->input('Nombre_Rol');
        $roles->save();
        return redirect()->action('RolController@index');
    }
    public function edit($id){
        $roles = Rol::find($id);
        return view('Nomina.Rol.edit',['rol'=> $roles]);
    }

    public function update(Request $request, $id){
        $roles = Rol::findOrFail($id);
        $roles->Nombre_Rol = $request->get('Nombre_Rol');
        $roles->update();
        return redirect()->action('RolController@index');
    }

    public function destroy($id){
        $roles=Rol::findOrFail($id);
        $roles->delete();
        return route('Nomina.Rol.index', ['Eliminado' => true]);
    }
}
