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
            'elo' => 1499,
            'image' => '/images/newbie.png',

        ]);
        DB::table('titles')->insert([
            'name' => 'Green',
            'elo' => 1500,
            'image' => '/images/master.png',

        ]);

        DB::table('titles')->insert([
            'name' => 'Yellow',
            'elo' => 2000,
            'image' => '/images/grandmaster.png',

        ]);

        DB::table('titles')->insert([
            'name' => 'Blue',
            'elo' => 2500,
            'image' => '/images/grandmaster.png',

        ]);
        DB::table('titles')->insert([
            'name' => 'White',
            'elo' => 3000,
            'image' => '/images/grandmaster.png',

        ]);
    }
}
