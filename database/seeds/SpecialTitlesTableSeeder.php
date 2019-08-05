<?php

use Illuminate\Database\Seeder;

class SpecialTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('special__titles')->insert([
            'name' => 'GrandMaster'
        ]);
        DB::table('special__titles')->insert([
            'name' => 'Master'
        ]);
    }
}
