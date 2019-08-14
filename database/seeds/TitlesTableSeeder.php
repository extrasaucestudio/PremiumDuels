<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('titles')->insert([
            'name' => 'Red',
            'elo' => 1399,
            'image' => '/images/ranks/red.png',
            'color' => 'red',

        ]);
        DB::table('titles')->insert([
            'name' => 'Green',
            'elo' => 1400,
            'image' => '/images/ranks/green.png',
            'color' => 'green',

        ]);

        DB::table('titles')->insert([
            'name' => 'Yellow',
            'elo' => 1600,
            'image' => '/images/ranks/yellow.png',
            'color' => 'yellow',

        ]);

        DB::table('titles')->insert([
            'name' => 'Blue',
            'elo' => 1800,
            'image' => '/images/ranks/blue.png',
            'color' => 'blue',

        ]);
        DB::table('titles')->insert([
            'name' => 'White',
            'elo' => 2000,
            'image' => '/images/ranks/white.png',
            'color' => 'white',

        ]);
    }
}
