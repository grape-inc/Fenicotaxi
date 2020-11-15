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
        
        DB::table('Rol')->insert([
            'ID_Rol' => '2',
            'Nombre_Rol' => 'Cajero'
        ]);

        DB::table('Rol')->insert([
            'ID_Rol' => '3',
            'Nombre_Rol' => 'Bodega'
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
