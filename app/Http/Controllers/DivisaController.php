<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Divisa;
use GuzzleHttp\Client;
use DB;

class DivisaController extends Controller
{
    public function index(Request $Request){
        return view('Configuracion.Divisa.index') ->with('Divisa', Divisa::all());
    }

    public function edit($ID){
        return view("Configuracion.Divisa.edit ",["Divisa"=>Divisa::findOrFail($ID)]);
    }

    public function update(Request $Request, $ID){
        $Request->validate([
            'Equivalencia_Cordoba' => 'required'
        ]);
        $Divisa = Divisa::findOrFail($ID);
        $Divisa->Equivalencia_Cordoba=$Request->get('Equivalencia_Cordoba');
        $Divisa->update();
        return redirect()->action('DivisaController@index',['Actualizado'=>true]);
    }

    public function create(Request $Request){
        $Cliente = new Client();
        $Response = $Cliente->request('POST', 'https://www.baccredomatic.com/es-ni/bac/exchange-rate-ajax/es-ni');
        $DS = json_decode(($Response->getBody()->getContents()));

        #Actualizar la divisa de dolares
        $Divisa = Divisa::findOrFail(1);
        $Divisa->Equivalencia_Cordoba=$DS->saleRateUSD;
        $Divisa->update();

        return redirect()->action('DivisaController@index',['Actualizado'=>true]);
    }
}
