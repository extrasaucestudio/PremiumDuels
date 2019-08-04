<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Duel;
use App\Title;

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
          $user = User::Where('name', $user)->first();
          if(!$user) return \Redirect::to('/');
          }

   

        $users = User::OrderBy('elo', 'DESC')->get();

        $duels = Duel::Where('winner_id', $user->id)->orWhere('loser_id', $user->id)->count();


    
        $winratio = '0%';
        if($user->DuelsWon->count() != 0 || $user->DuelsWon->count() != null) {
            $winratio = floor($user->DuelsWon->count()/$duels*100) . '%';
        } 


        $name = $user->name;
        $rank = $users->search(function ($person, $key) use ($name) {
            return $person->name == $name;
        });
        $rank++;

        $nextRank = Title::Where('elo', '>', $user->elo)->orderBy('elo', 'DESC')->first();

  

       
        if(!$nextRank) {
            $nextRank = 'None';
        } 

        $LastDuels = Duel::Where('winner_id', $user->id)->orWhere('loser_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return view('home', compact('user', 'duels', 'rank', 'nextRank', 'winratio', 'LastDuels'));
    }

}
