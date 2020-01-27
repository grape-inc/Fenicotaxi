<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use DB;


class ProductoController extends Controller
{
    public function index(Request $Request){
        return view('Inventario.Productos.index') ->with('Productos', Producto::all());
    }
}
