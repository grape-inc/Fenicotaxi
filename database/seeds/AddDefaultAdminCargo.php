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
        DB::table('cargo')->insert([
            'Nombre_cargo' => 'Admin',
            'Salario_Cargo' => '0000'
        ]);
    }
}
