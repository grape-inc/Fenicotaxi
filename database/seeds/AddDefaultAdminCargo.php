<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddDefaultAdminCargo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Cargo')->insert([
            'ID_Cargo' => '1',
            'Nombre_cargo' => 'Administrador',
            'Salario_Cargo' => '0000'
        ]);
    }
}
