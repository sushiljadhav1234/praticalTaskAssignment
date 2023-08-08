<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        \DB::table('users')->insert([
            'name' => 'normal user',
            'email' => 'normalUser1177@gmail.com',
            'password' => \Hash::make('normalUser1177'), 
            'role_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'super admin',
            'email' => 'superadmin1178@gmail.com',
            'password' => Hash::make('superadmin1178'), 
            'role_id' => null, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
