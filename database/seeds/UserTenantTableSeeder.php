<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Entities\UserTenant;
class UserTenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTenant = new UserTenant();
        $userTenant->user_id = 1;
        $userTenant->tenant_id = 1;
        
        $userTenant->save();

        $userTenant = new UserTenant();
        $userTenant->user_id = 2;
        $userTenant->tenant_id = 1;
        
        $userTenant->save();
    }
}
