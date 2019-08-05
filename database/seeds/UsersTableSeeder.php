<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => bcrypt('password'),
            'secret_key' => 'password',
            'uid' => 111,
            'title_id' => 2,
            'elo' => 2500,
            'active' => true,
            'country_code' => 'de',
            'golden_account' => true,
        ]);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'password' => bcrypt('password'),
            'secret_key' => 'password',
            'uid' => 112,
            'title_id' => 2,
            'elo' => 2500,
            'active' => true,
            'country_code' => 'ru',

        ]);
    }
}
