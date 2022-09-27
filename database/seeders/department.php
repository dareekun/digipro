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
            ['department' => 'Developer', 'remark' => NULL],
            ['department' => 'Common', 'remark' => NULL],
            ['department' => 'Production', 'remark' => NULL],
            ['department' => 'Quality Control', 'remark' => NULL],
            ['department' => 'Warehouse', 'remark' => NULL],

        ]);
    }
}
