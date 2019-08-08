<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Title;
use App\Duel;



class PagesController extends Controller
{

    public function welcome()
    {
        $users = User::Where('active', 1)->orderBy('elo', 'DESC')->get();
        $duels = Duel::orderBy('created_at', 'DESC')->get();


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


        return view('welcome', compact('users', 'duels', 'serverData'));
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
        return view('Tournaments');
    }
    public function About()
    {
        return view('About');
    }
    public function School()
    {
        return view('School');
    }




    public function test(Request $request)
    {

        $user = User::first();
        dd($user->UserItems);
    }
}
