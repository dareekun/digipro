<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Developer',
            'username' => 'developer',
            'password' => bcrypt('developer123'),
            'department' => 999,
            'role' => 'developer',
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'department' => 1,
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'Manager',
            'username' => 'manager',
            'password' => bcrypt('manager123'),
            'department' => 1,
            'role' => 'manager',
        ]);
        DB::table('users')->insert([
            'name' => 'Operator',
            'username' => 'operator',
            'password' => bcrypt('operator123'),
            'department' => 1,
            'role' => 'user',
        ]);
    }
}
