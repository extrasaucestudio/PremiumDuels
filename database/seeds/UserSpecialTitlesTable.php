<?php

use Illuminate\Database\Seeder;

class UserSpecialTitlesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_special_titles')->insert([
            'special_title_id' => 2,
            'user_id' => 1,

        ]);
        DB::table('user_special_titles')->insert([
            'special_title_id' => 2,
            'user_id' => 1,

        ]);

        DB::table('user_special_titles')->insert([
            'special_title_id' => 1,
            'user_id' => 2,

        ]);
    }
}
