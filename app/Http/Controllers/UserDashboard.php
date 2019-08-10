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


        $DuelWL = new stdClass;
        $DuelWL->loses = Duel::where('loser_id', $user->id)->count();
        $DuelWL->wins = Duel::where('winner_id', $user->id)->count();


        function CalculatePlaceInLeaderboard1($user)
        {
            $users = User::orderBy('elo', 'DESC')->get();
            $name = $user->name;
            $rank = $users->search(function ($person, $key) use ($name) {
                return $person->name == $name;
            });
            $rank++;
            return $rank;
        }


        $PlaceInLeaderboard = CalculatePlaceInLeaderboard1($user);


        return view('user.index', compact('user', 'duels', 'nextRank', 'DuelWL', 'PlaceInLeaderboard'));
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


    public function foreign_profile(Request $request, $uid)
    {

        $user = Auth::user();
        $foreign_user = User::find($uid);
        if (!$foreign_user) return \Redirect::to('/home');
        if ($foreign_user->id == $user->id) return \Redirect::to('/home');


        $nextRank = Title::Where('elo', '>', $foreign_user->elo)->orderBy('elo', 'DESC')->first();

        if (!$nextRank) {
            $nextRank = new stdClass;
            $nextRank->name = 'None';
            $nextRank->percent = 100;
            $nextRank->color = 'gold';
        } else {

            $nextRank->percent = floor(($foreign_user->elo / $nextRank->elo) * 100);
        }

        $DuelWL = new stdClass;

        if ($request->wl == 'me') {
            $DuelWL->loses = Duel::where('loser_id', $foreign_user->id)->Where('winner_id', $user->id)->count();
            $DuelWL->wins = Duel::where('winner_id', $foreign_user->id)->Where('loser_id', $user->id)->count();
        } else {
            $DuelWL->loses = Duel::where('loser_id', $foreign_user->id)->count();
            $DuelWL->wins = Duel::where('winner_id', $foreign_user->id)->count();
        }



        function CalculatePlaceInLeaderboard2($user)
        {
            $users = User::orderBy('elo', 'DESC')->get();
            $name = $user->name;
            $rank = $users->search(function ($person, $key) use ($name) {
                return $person->name == $name;
            });
            $rank++;
            return $rank;
        }


        $PlaceInLeaderboard = CalculatePlaceInLeaderboard2($foreign_user);

        return view('user.pages.user-profile', compact('user', 'foreign_user', 'nextRank', 'DuelWL', 'rank', 'PlaceInLeaderboard'));
    }
}
