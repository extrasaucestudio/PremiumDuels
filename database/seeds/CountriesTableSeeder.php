<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name' => 'United States',
            'country_code' => 'us',

        ]);
        DB::table('countries')->insert([
            'name' => 'Germany',
            'country_code' => 'de',

        ]);
    }
}
