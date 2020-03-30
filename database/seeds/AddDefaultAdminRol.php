<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddDefaultAdminRol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Rol')->insert([
            'ID_Rol' => '1',
            'Nombre_Rol' => 'Admin'
        ]);

        DB::table('Tipo_Factura')->insert([
            'ID_TipoFactura' => '1',
            'NombreTipo' => 'CONTADO'
        ]);

        DB::table('Tipo_Factura')->insert([
            'ID_TipoFactura' => '2',
            'NombreTipo' => 'CREDITO'
        ]);
    }
}
