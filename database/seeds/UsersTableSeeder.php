<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'golden_account' => true,
            'admin' => 1,
            'country_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
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
            'country_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    }
}
