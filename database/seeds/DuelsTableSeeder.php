<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DuelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duels')->insert([
            'winner_id' => 1,
            'loser_id' => 2,
            'winner_score' => 6,
            'loser_score' => 1,
            'winner_elo_plus' => 1,
            'loser_elo_minus' => -1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('duels')->insert([
            'winner_id' => 2,
            'loser_id' => 1,
            'winner_score' => 4,
            'loser_score' => 3,
            'winner_elo_plus' => 1,
            'loser_elo_minus' => -1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('duels')->insert([
            'winner_id' => 1,
            'loser_id' => 2,
            'winner_score' => 5,
            'loser_score' => 2,
            'winner_elo_plus' => 1,
            'loser_elo_minus' => -1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('duels')->insert([
            'winner_id' => 1,
            'loser_id' => 2,
            'winner_score' => 5,
            'loser_score' => 2,
            'winner_elo_plus' => 1,
            'loser_elo_minus' => -1,
            'created_at' => new \DateTime('-4 day'),
        ]);
    }
}
