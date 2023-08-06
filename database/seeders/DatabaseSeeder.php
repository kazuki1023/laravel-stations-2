<?php

namespace Database\Seeders;

use App\Models\Practice;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Sheet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

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
        Movie::factory(40)->has(
            Schedule::factory(10)->state(function() {
                $start_time = CarbonImmutable::now()->addMinutes(rand(1, 300));
                return [
                    'start_time' => $start_time,
                    'end_time' => $start_time->addHours(2),
                ];
            }))->create();
        $this->call([
            SheetTableSeeder::class,
        ]);
    }
}
