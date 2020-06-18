<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddDefaultCurrency extends Seeder
{
    public function run()
    {
        DB::table('Divisa')->insert([
            'ID_Divisa' => '1',
            'Nombre_Divisa' => 'Dolares (USD)',
            'Equivalencia_Cordoba' => '0',
            'Simbolo_Divisa' => 'USD'
        ]);
        DB::table('Divisa')->insert([
            'ID_Divisa' => '2',
            'Nombre_Divisa' => 'Cordobas (C$)',
            'Equivalencia_Cordoba' => '1',
            'Simbolo_Divisa' => 'C$'
        ]);
    }
}