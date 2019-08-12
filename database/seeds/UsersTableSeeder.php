<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Champion Owner | Admin';
        $user->email = Str::random(10) . '@none.com';
        $user->password = bcrypt('password');
        $user->secret_key = 'password';
        $user->uid = 112;
        $user->elo = 1000;
        $user->active = false;
        $user->golden_account = true;
        $user->admin = 1;
        $user->save();


        $user = new User;
        $user->name = 'Developer | Pitch';
        $user->email = Str::random(10) . '@none.com';
        $user->password = bcrypt('password');
        $user->secret_key = 'password';
        $user->uid = 111;
        $user->elo = 1000;
        $user->active = false;
        $user->golden_account = true;
        $user->admin = 1;
        $user->save();



        $user = new User;
        $user->name = 'New user';
        $user->email = Str::random(10) . '@none.com';
        $user->password = bcrypt('password');
        $user->secret_key = 'password';
        $user->uid = 555;
        $user->elo = 1000;
        $user->active = false;

        $user->admin = 1;
        $user->save();
    }
}
