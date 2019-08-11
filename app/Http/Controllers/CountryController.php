<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use App\User;

class CountryController extends Controller
{
    public function rank_countries()
    {

        $users = User::where('active', true)->get();


        \DB::table('countries')->update(['elo' => 0, 'members_num' => 0]);



        foreach ($users as $key => $user) {
            $user->Country->increment('elo', $user->elo);
            $user->Country->increment('members_num', 1);
            $user->Country->save();
        }

        $countries =  Country::all();


        foreach ($countries as $key => $country) {
            if ($country->members_num == 0) continue;
            $country->elo = ($country->elo / $country->members_num);
            $country->save();
        }
    }
}
