<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddDefaultTipoPago extends Seeder
{
    public function run()
    {
        DB::table('tipo_pago')->insert([
            'ID' => '1',
            'Tipo_Pago' => 'Efectivo'
        ]);

        DB::table('tipo_pago')->insert([
            'ID' => '2',
            'Tipo_Pago' => 'Tarjeta'
        ]);

        DB::table('tipo_pago')->insert([
            'ID' => '3',
            'Tipo_Pago' => 'Cheque'
        ]);
    }
}