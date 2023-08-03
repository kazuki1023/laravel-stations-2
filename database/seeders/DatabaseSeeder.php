<?php

namespace Database\Seeders;

use App\Models\Practice;
use App\Models\Movie;
use App\Models\Sheet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        Movie::factory(40)->create();
        $this->call([
            SheetTableSeeder::class,
        ]);
    }
}
