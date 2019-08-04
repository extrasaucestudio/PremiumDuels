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
        $users = User::all();
        $duels = Duel::orderBy('created_at', 'DESC')->get();
    
        return view('welcome', compact('users', 'duels'));
    }

    public function search()
    {
        $users = User::all();
        return response()->json($users);

        
        
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $users = User::where('name', 'LIKE', "%{$query}%")->get();


    if($users->isEmpty()) return 1;
    
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($users as $row)
      {
       $output .= '
       <li><a href="/user/'. $row->name.'">'.$row->name.'<img class="rank_img" src="'. $row->Title->image .'"></a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }



    public function test()
    {
       $elo = 1800;

       $titles = Title::Where('elo', '<=', $elo)->orderBy('elo', 'DESC')->first();
       

       $user = User::first();
       return '1|' . $user->Title->name . '|';
      
    }
}
