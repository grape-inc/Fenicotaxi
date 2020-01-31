<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Empleado;
use App\Cargo;
use App\Rol;
use Carbon\Carbon;
use DB;
use Session;

class EmpleadoController extends Controller
{
    public function index(Request $Request){
        $Empleado = DB::table('empleado')
            ->join('cargo', 'empleado.id_cargo', '=', 'cargo.id_cargo')            
            ->get();        
        return view('Nomina.Empleado.index') ->with('Empleado', $Empleado);
    }

    public function create(){
        $Cargos =  Cargo::all();
        $Roles =  Rol::all();
        return view ('Nomina.Empleado.create',[
            'Cargos' => $Cargos,
            'Roles' => $Roles
        ]);
    }

    public function store(Request $Request){        
        $Base = "";        
        if ($Request->hasFile('Imagen')) {
            $Base = $Request->file('Imagen')->getRealPath();
            $Base = file_get_contents($Base);
            $Base = base64_encode($Base);
        }           
        $Request->validate([            
            'Nombre_Empleado' => 'required|max:100',
            'Apellido_Empleado' => 'required',
            'Fecha_Nacimiento' => 'required',
            'Cedula' => 'required',
            'Correo' => 'required',
            'ID_Cargo' => 'required',
            'ID_Rol' => 'required',
        ]);

        $Empleado = new Empleado();        
        $Empleado->Nombre_Empleado=$Request->get('Nombre_Empleado');
        $Empleado->Apellido_Empleado=$Request->get('Apellido_Empleado');
        $Empleado->Fecha_Nacimiento=$Request->get('Fecha_Nacimiento');
        $Empleado->Cedula=$Request->get('Cedula');
        $Empleado->Fecha_Ingreso=Carbon::now();
        $Empleado->Correo=$Request->get('Correo');
        $Empleado->ID_Cargo=$Request->get('ID_Cargo');
        $Empleado->ID_Rol=$Request->get('ID_Rol');
        $Empleado->Imagen=$Base;
        $Empleado->save();
        return redirect()->action('EmpleadoController@index');
    }

    public function edit($ID){
        $Cargos =  Cargo::all();
        $Roles =  Rol::all();
        $Empleado = Empleado::find($ID);
        return view ('Nomina.Empleado.edit',[
            'Cargos' => $Cargos,
            'Roles' => $Roles,
            'Empleado' => $Empleado
        ]);
    }

    public function update(Request $Request, $ID){
        $Base = "";
        if ($Request->hasFile('Imagen')) {
            $Base = $Request->file('Imagen')->getRealPath();
            $Base = file_get_contents($Base);
            $Base = base64_encode($Base);
        }   
        
        $Request->validate([            
            'Nombre_Empleado' => 'required|max:100',
            'Apellido_Empleado' => 'required',
            'Fecha_Nacimiento' => 'required',
            'Cedula' => 'required',            
            'Correo' => 'required',
            'ID_Cargo' => 'required',
            'ID_Rol' => 'required',
        ]);

        $Empleado = Empleado::findOrFail($ID);
        $Empleado->Nombre_Empleado=$Request->get('Nombre_Empleado');
        $Empleado->Apellido_Empleado=$Request->get('Apellido_Empleado');
        $Empleado->Fecha_Nacimiento=$Request->get('Fecha_Nacimiento');
        $Empleado->Cedula=$Request->get('Cedula');
        $Empleado->Fecha_Ingreso=Carbon::now();
        $Empleado->Correo=$Request->get('Correo');
        $Empleado->ID_Cargo=$Request->get('ID_Cargo');
        $Empleado->ID_Rol=$Request->get('ID_Rol');
        if ($Base != ""){
            $Empleado->Imagen=$Base;
        }
        $Empleado->update();
        $Usuario = Empleado::where('ID_Empleado', session("ID_Empleado"))->first();
        Session::put('Nombre', $Usuario->Nombre_Empleado);
        Session::put('Apellido', $Usuario->Apellido_Empleado);
        Session::put('Imagen', $Usuario->Imagen);
        return redirect()->action('EmpleadoController@index');
    }
    public function destroy($ID){
        $Empleado=Empleado::findOrFail($ID);
        $Empleado->where('ID_Empleado',$ID)->delete();
        return route('Empleado.index', ['Eliminado' => true]);
    }
}