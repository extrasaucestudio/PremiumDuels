<?php

use Illuminate\Database\Seeder;

class user_elo_historiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('user_elo_histories')->insert([
            'elo' => 1800,
            'user_id' => 1,
            'created_at' => new \DateTime('-9 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 1800,
            'user_id' => 1,
            'created_at' => new \DateTime('-8 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 1800,
            'user_id' => 1,
            'created_at' => new \DateTime('-7 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 1800,
            'user_id' => 1,
            'created_at' => new \DateTime('-6 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 200,
            'user_id' => 1,
            'created_at' => new \DateTime('-5 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 2100,
            'user_id' => 1,
            'created_at' => new \DateTime('-4 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 2200,
            'user_id' => 1,
            'created_at' => new \DateTime('-3 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 2300,
            'user_id' => 1,
            'created_at' => new \DateTime('-2 day'),

        ]);
        DB::table('user_elo_histories')->insert([
            'elo' => 2400,
            'user_id' => 1,
            'created_at' => new \DateTime('-1 day'),

        ]);
    }
}
