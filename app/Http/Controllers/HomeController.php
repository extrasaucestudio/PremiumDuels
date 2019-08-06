<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Duel;
use App\Title;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $user = null)
    {
        if (\Request::is('home')) {
            $user = \Auth::user();
        } else {
            $user = User::find($user);

            if (!$user) return \Redirect::to('/');
        }



        $users = User::OrderBy('elo', 'DESC')->get();

        $duels = Duel::Where('winner_id', $user->id)->orWhere('loser_id', $user->id)->count();



        $winratio = '0%';
        if ($user->DuelsWon->count() != 0 || $user->DuelsWon->count() != null) {
            $winratio = floor($user->DuelsWon->count() / $duels * 100) . '%';
        }


        $name = $user->name;
        $rank = $users->search(function ($person, $key) use ($name) {
            return $person->name == $name;
        });
        $rank++;

        $nextRank = Title::Where('elo', '>', $user->elo)->orderBy('elo', 'DESC')->first();




        if (!$nextRank) {
            $nextRank = 'None';
        }

        $LastDuels = Duel::Where('winner_id', $user->id)->orWhere('loser_id', $user->id)->orderBy('created_at', 'DESC')->get();


        if ($me = Auth::user()) {
            $WonAgainst = Duel::Where('winner_id', $me->id)->Where('loser_id', $user->id)->count();
            $LostAgainst = Duel::Where('winner_id', $user->id)->Where('loser_id', $me->id)->count();
        } else {
            $WonAgainst = -1;
            $LostAgainst = -1;
        }


        return view('home', compact('user', 'duels', 'rank', 'nextRank', 'winratio', 'LastDuels', 'WonAgainst', 'LostAgainst'));
    }

    public function user_settings()
    {
        $user = Auth::user();

        return view('user_settings', compact('user'));
    }


    public function ChangeSettings(Request $request)
    {
        $user = Auth::user();
        $passChanged = 0;



        if (!$user) return \Redirect::to('/settings');

        if ($request->password != null && strlen($request->password) > 4) {

            $pass = $request->password;
            $user->password = bcrypt($pass);
            $user->secret_key = $pass;

            $passChanged = 1;
        }
        if ($request->hidePass == null) {
            $user->hidePass = 0;
        } else {
            $user->hidePass = 1;
        }
        $user->save();

        if ($passChanged == 1) {
            return redirect()->to('/settings')->with('success', 'You changed password successfully');
        } else if ($passChanged == 0 && $request->password != null) {
            return redirect()->to('/settings')->with('error', 'Error occurs while changing your password. Min password lenght is equal to 5.');
        } else {
            return redirect()->to('/settings')->with('success', 'Data updated successfully');
        }
    }
}
