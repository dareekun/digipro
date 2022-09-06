<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class department extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department_list')->insert([
            ['id' => 999, 'department' => 'Developer', 'remark' => NULL],
            ['id' => 0, 'department' => 'Common', 'remark' => NULL],
            ['id' => 1, 'department' => 'Production', 'remark' => NULL],
            ['id' => 2, 'department' => 'Quality Control', 'remark' => NULL],
            ['id' => 3, 'department' => 'Warehouse', 'remark' => NULL]

        ]);
    }
}
