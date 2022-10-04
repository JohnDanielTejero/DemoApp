<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Admin',
            'role_description' => 'Users with admin privileges',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Member',
            'role_description' => 'Users that requires the service',
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Caregiver',
            'role_description' => 'Users that helps a member',
        ]);

    }
}
