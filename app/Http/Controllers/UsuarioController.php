<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Empleado;
use DB;

class UsuarioController extends Controller
{
    public function index(Request $Request){
        $Empleado= Empleado::all();
        return view('Configuracion.Usuario.index') ->with('Empleado', $Empleado);
    }

    public function edit($ID){        
        $Usuario = Empleado::find($ID);                
        return view ('Configuracion.Usuario.edit',[        
            'Usuario' => $Usuario
        ]);
    }

    public function update(Request $Request, $ID){
        
        $Request->validate([
            'ID_Empleado' => 'required',
            'Usuario' => 'required',
            'Password' => 'required'
        ]);

        $Empleado = Empleado::findOrFail($ID);
        $Empleado->Usuario=$Request->get('Usuario');
        $Empleado->Password=bcrypt($Request->get('Password'));
        
        $Empleado->update();
        return redirect()->action('UsuarioController@index');
    }
    public function destroy($ID){        
        $Empleado=Empleado::findOrFail($ID);
        $Empleado->Usuario=null;
        $Empleado->Password=null;
        $Empleado->update();
        return route('Usuarios.index', ['Eliminado' => true]);
    }
}
