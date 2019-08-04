<?php

use Illuminate\Database\Seeder;

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
        ]);
    }
}
