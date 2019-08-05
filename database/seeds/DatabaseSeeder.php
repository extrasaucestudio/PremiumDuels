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
        $this->call(TitlesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DuelsTableSeeder::class);
        $this->call(SpecialTitlesTableSeeder::class);
        $this->call(UserSpecialTitlesTable::class);
    }
}
