<?php

use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach(range(1, 10) as $index) {
            \Illuminate\Support\Facades\DB::table('movies')->insert([
               'title' => $faker->sentence(3),
               'url' => 'https://www.youtube.com/watch?v=AAqATW60uFM'
            ]);
        }
    }
}
