<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AddDefaultAdminRol::class);
        $this->call(AddDefaultAdminCargo::class);
        $this->call(AddDefaulAdmin::class);
        $this->call(AddDefaultCurrency::class);
        $this->call(AddDefaultTipoPago::class);
    }
}
