<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Title;
use App\Duel;
use App\Country;
use App\Tournament;



class PagesController extends Controller
{

    public function welcome()
    {
        $users = User::orderBy('elo', 'DESC')->Where('active', 1)->get();
        $duels = Duel::orderBy('created_at', 'DESC')->get();
        $tournaments = Tournament::where('state', 'awaiting')->count();


        $LastDuels = Duel::orderBy('created_at', 'DESC')->whereHas('Duel_winner', function ($query) {
            $query->where('active', 1);
        })
            ->whereHas('Duel_loser', function ($query) {
                $query->where('active', 1);
            })
            ->get();



        return view('welcome', compact('users', 'duels', 'tournaments', 'LastDuels'));
    }

    public function search()
    {
        $users = User::all();
        return response()->json($users);
    }

    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $users = User::where('name', 'LIKE', "%{$query}%")->Where('active', 1)->get();


            if ($users->isEmpty()) return 1;

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($users as $row) {
                $gold = '';
                if ($row->golden_account == true) {
                    $gold = '&nbsp <i class="fas fa-coins"></i>';
                }
                $output .= '
       <li><a class="uk-link-reset" href="/user/' . $row->uid . '">' . $row->name . $gold . '<img class="rank_img" src="' . $row->Title->image . '"></a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }



    public function HallOfFame()
    {
        return view('HallOfFame');
    }

    public function donate()
    {
        return view('donate');
    }

    public function Tournaments()
    {

        $tournaments = Tournament::orderBy('created_at', 'DESC')->get();
        return view('Tournaments', compact('tournaments'));
    }


    public function Tournament($id)
    {

        $tournament = Tournament::find($id);
        return view('Tournament', compact('tournament'));
    }

    public function About()
    {
        $users = User::orderBy('elo', 'DESC')->get();
        $duels = Duel::orderBy('created_at', 'DESC')->get();
        $tournaments = Tournament::where('state', 'awaiting')->count();
        $LastDuels = Duel::orderBy('created_at', 'DESC')->get();

        return view('welcome_rebuild', compact('users', 'duels', 'tournaments', 'LastDuels'));
    }


    public function School()
    {
        return view('School');
    }

    public function PlayersOnline()
    {
        function getPlayersOnServer()
        {
            $myFile = 'http://www.mnbcentral.net/min';

            $str = 'MasterFrog_Vasilisa';

            function getLineWithString($fileName, $str)
            {
                $lines = file($fileName);
                foreach ($lines as $lineNumber => $line) {
                    if (strpos($line, $str) !== false) {
                        return $line;
                    }
                }
                return -1;
            }

            $data = explode(",", getLineWithString($myFile, $str));
            return $data;
        }


        $serverData = getPlayersOnServer();

        return $serverData[5] ?? -1;
    }


    public function test(Request $request)
    { }
}
