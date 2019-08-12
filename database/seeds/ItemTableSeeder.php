<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'game_id' => 363,
            'name' => 'Great Helmet',
            'image' => 'test',
            'type' => 'helmet',
        ]);

        DB::table('items')->insert([
            'game_id' => 564,
            'name' => 'Strange Armor',
            'image' => 'test',
            'type' => 'armor',
        ]);

        DB::table('items')->insert([
            'game_id' => 614,
            'name' => 'Power Gloves',
            'image' => 'test',
            'type' => 'gloves',
        ]);
        DB::table('items')->insert([
            'game_id' => 565,
            'name' => 'Strange Boots',
            'image' => 'test',
            'type' => 'boots',
        ]);
        DB::table('items')->insert([
            'game_id' => 568,
            'name' => 'Strange Sword',
            'image' => 'test',
            'type' => 'weapon',
        ]);


        DB::table('items')->insert([
            'game_id' => 26645,
            'name' => 'For Test Gloves',
            'image' => 'test',
            'type' => 'gloves',
        ]);

        DB::table('items')->insert([
            'game_id' => 2645,
            'name' => 'For Test Boots',
            'image' => 'test',
            'type' => 'boots',
        ]);
    }
}
