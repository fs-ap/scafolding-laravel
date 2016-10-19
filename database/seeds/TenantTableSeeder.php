<?php

use Illuminate\Database\Seeder;
use App\Entities\Tenant;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
        	'name' => 'E. E. CASTRO ALVES',
        	'description' => 'Escola Estadual Castro Alves',
        	'enabled' => true
        ]);

        Tenant::create([
        	'name' => 'E. E. TIRADENTES',
        	'description' => 'Escola Estadual Tiradentes',
        	'enabled' => true
        ]);

        Tenant::create([
        	'name' => 'EEPGAC',
        	'description' => 'Escola Estadual Professor Gabriel de Almeida Café',
        	'enabled' => true
        ]);
    }
}
