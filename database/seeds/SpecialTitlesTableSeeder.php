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
            'name' => 'GrandMaster',
            'class' => 'Major',
        ]);
        DB::table('special__titles')->insert([
            'name' => 'Champion',
            'class' => 'Major',
        ]);
        DB::table('special__titles')->insert([
            'name' => 'Ex-Champion',
            'class' => 'Minor',
        ]);
    }
}
