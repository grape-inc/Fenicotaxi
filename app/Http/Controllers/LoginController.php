<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
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
            if(Hash::check($Request->Password, $Usuario->Password))
                return redirect()->action('DashboardController@index');
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

}
