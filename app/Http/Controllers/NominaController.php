<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nomina;
use App\NominaDetalle;
use Illuminate\Support\Facades\Redirect;
use DB;

class NominaController extends Controller
{
    public function index(Request $Request){
        return view('nomina.Nomina.index') ->with('Nomina', Nomina::all());
    }
}
