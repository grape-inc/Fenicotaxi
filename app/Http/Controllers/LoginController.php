<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Empleado;

class LoginController extends Controller
{
    public function index(Request $Request){
        return view('Login.index');
    }

    public function store(Request $Request){
        $Request->validate([
            'Usuario' => 'required',
            'Password' => 'required'
        ]);

        $Usuario = Empleado::where('Usuario', $Request->Usuario)->first();

        if($Usuario != null){
            Session::put('ID_Empleado', $Usuario->ID_Empleado);
            Session::put('Nombre', $Usuario->Nombre_Empleado);
            Session::put('Apellido', $Usuario->Apellido_Empleado);
            Session::put('Imagen', $Usuario->Imagen);
            Session::put('Rol', $Usuario->ID_Rol);
            Session::put('Usuario', $Usuario->Usuario);
            if(Hash::check($Request->Password, $Usuario->Password))
                return redirect()->action('WelcomeController@index');
            else{
                flash('La contraseña no es correcta.')->error();
                return redirect()->back();
            }
        }
        else{
            flash('El usuario no existe.')->error();
            return redirect()->back();
        }
    }

    public function matar_sesion(Request $Request){
        Session::flush();
        return redirect('Login');
    }
}
