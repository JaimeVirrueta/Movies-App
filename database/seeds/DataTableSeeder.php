<?php

use App\Models\Movie;
use App\Models\Turn;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Movie::truncate();
        Turn::truncate();

        $turns = factory(Turn::class, rand(10, 25))->create();
        factory(Movie::class, rand(20, 50))->create()->each(function ($movie) {
            $turns = Turn::inRandomOrder()->take(random_int(2, 6))->get();
            $movie->turns()->saveMany($turns);
        });

        Schema::enableForeignKeyConstraints();
    }
}
