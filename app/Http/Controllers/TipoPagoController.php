<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPago;
use Illuminate\Support\Facades\Redirect;
use DB;

class TipoPagoController extends Controller
{
    public function index(Request $request){
        return view('Facturacion.TipoPago.index') ->with('TipoPago', TipoPago::all());
    }

    public function create(){
        return view ('Facturacion.TipoPago.create');
    }

    public function store(Request $Request){
        $Request->validate([
            'Tipo_Pago' => 'required|max:60'
        ]);
        $TipoPago = new TipoPago();
        $TipoPago->Tipo_Pago=$Request->get('Tipo_Pago');
        $TipoPago->save();
        return redirect()->action('TipoPagoController@index');
    }

    public function edit($ID){
        return view("Facturacion.TipoPago.edit ",["TipoPago"=>TipoPago::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Request->validate([
            'Tipo_Pago' => 'required|max:60'
        ]);
        $TipoPago=TipoPago::findOrFail($ID);
        $TipoPago->Tipo_Pago=$Request->get('Tipo_Pago');
        $TipoPago->update();
        return redirect()->action('TipoPagoController@index');
    }
    public function destroy($ID){
        $Eliminado = true;
        try {
            $TipoPago=TipoPago::findOrFail($ID);
            $TipoPago->delete();
        } catch (\Exception $E) {
            $Eliminado = false;
        }
        return route('TipoPago.index', ['Eliminado' => $Eliminado]);
    }
}
