<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddDefaulAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Empleado')->insert([
            'ID_Empleado' => '1',
            'Nombre_Empleado' => 'Admin',
            'Apellido_Empleado' => 'Admin',
            'Fecha_Nacimiento' => '2020-01-01',
            'Cedula' => '000-000000-0000A',
            'Fecha_Ingreso' => '2020-01-01',
            'Usuario' => 'Admin',
            'Password'=> Hash::make('password'),
            'Correo' => 'admin@admin.com',
            'ID_Cargo' => '1',
            'ID_Rol' => '1'
        ]);
    }
}
