<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
        	'name' => 'Paulo Silva',
        	'email' => '05.paulotarso@gmail.com',
        	'password' => bcrypt('123456')
        ]);
        \App\User::create([
            'name' => 'Vitor Hugo',
            'email' => 'vhsilva.ap@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
