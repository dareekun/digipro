<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(department::class);
        $this->call(parts::class);
        $this->call(product::class);
        $this->call(users::class);
        $this->call(easter::class);
    }
}
