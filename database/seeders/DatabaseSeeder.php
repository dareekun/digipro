<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Developer',
            'username' => 'developer',
            'password' => bcrypt('developer123'),
            'role' => 'developer',
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'User 01',
            'username' => 'user1',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 02',
            'username' => 'user2',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 03',
            'username' => 'user3',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 04',
            'username' => 'user4',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 05',
            'username' => 'user5',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 06',
            'username' => 'user6',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 07',
            'username' => 'user7',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 08',
            'username' => 'user8',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 09',
            'username' => 'user9',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
        DB::table('users')->insert([
            'name' => 'User 010',
            'username' => 'user10',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
    }
}
