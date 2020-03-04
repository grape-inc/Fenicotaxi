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
        DB::table('rol')->insert([
            'Nombre_Rol' => 'Admin'
        ]);
    }
}
