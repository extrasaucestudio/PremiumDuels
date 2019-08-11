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
            'game_id' => 1,
            'name' => 'item name over there',
            'image' => 'test',
            'type' => 'helmet',
        ]);

        DB::table('items')->insert([
            'game_id' => 2,
            'name' => 'armor',
            'image' => 'test',
            'type' => 'armor',
        ]);

        DB::table('items')->insert([
            'game_id' => 55,
            'name' => 'gloves',
            'image' => 'test',
            'type' => 'gloves',
        ]);
        DB::table('items')->insert([
            'game_id' => 88,
            'name' => 'booots',
            'image' => 'test',
            'type' => 'boots',
        ]);
        DB::table('items')->insert([
            'game_id' => 22,
            'name' => 'weapon',
            'image' => 'test',
            'type' => 'weapon',
        ]);
    }
}
