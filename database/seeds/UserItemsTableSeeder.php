<?php

use Illuminate\Database\Seeder;

class UserItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_items')->insert([
            'item_id' => 1,
            'user_id' => 1,

        ]);
        DB::table('user_items')->insert([
            'item_id' => 2,
            'user_id' => 1,

        ]);
        DB::table('user_items')->insert([
            'item_id' => 3,
            'user_id' => 1,

        ]);
        DB::table('user_items')->insert([
            'item_id' => 4,
            'user_id' => 1,

        ]);
        DB::table('user_items')->insert([
            'item_id' => 5,
            'user_id' => 1,

        ]);
    }
}
