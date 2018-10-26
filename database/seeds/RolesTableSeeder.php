<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->code = 'admin';
        $role_admin->save();
        
        $role_affiliate = new Role();
        $role_affiliate->name = 'Donator';
        $role_affiliate->code = 'donator';
        $role_affiliate->save();
    
        $role_member = new Role();
        $role_member->name = 'Beneficiary';
        $role_member->code = 'beneficiary';
        $role_member->save();
    
    }
}
