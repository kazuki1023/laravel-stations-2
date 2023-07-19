<?php

namespace Database\Seeders;

use App\Models\Practice;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // Practiceのテストデータを10個作成する

    public function run()
    {
        Movie::factory(100)->create();
    }
}
