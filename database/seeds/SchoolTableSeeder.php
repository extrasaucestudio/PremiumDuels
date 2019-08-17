<?php

use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'name' => 'Golden School',
            'capacity' => 999,
            'special_title_id' => 1,
            'owner_id' => 1,
            'extra_gloves_id' => 3,
            'extra_boots_id' => 4,
            'body' => 'Golden school',
        ]);
    }
}