<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Duel;
use App\Title;
use stdClass;
use App\User;
use App\Country;

class UserDashboard extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $duels = Duel::where('winner_id', $user->id)->orWhere('loser_id', $user->id)->get();
        $nextRank = Title::Where('elo', '>', $user->elo)->orderBy('elo', 'DESC')->first();

        if (!$nextRank) {
            $nextRank = new stdClass;
            $nextRank->name = 'None';
            $nextRank->percent = 100;
            $nextRank->color = 'gold';
        } else {

            $nextRank->percent = floor(($user->elo / $nextRank->elo) * 100);
        }




        return view('user.index', compact('user', 'duels', 'nextRank'));
    }


    public function leaderboard()
    {
        $user = Auth::user();
        $users = User::orderBy('elo', 'DESC')->get();
        return view('user.pages.leaderboard', compact('user', 'users'));
    }


    public function charts()
    {
        $user = Auth::user();


        $countries = Country::orderBy('elo', 'DESC')->get();


        return view('user.pages.charts', compact('user', 'countries'));
    }
}
