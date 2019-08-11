<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DuelsTableSeeder::class);
        $this->call(SpecialTitlesTableSeeder::class);
        $this->call(UserSpecialTitlesTable::class);
        $this->call(user_elo_historiesTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(UserItemsTableSeeder::class);
    }
}
