<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Zelenin\Elo\Player;
use Zelenin\Elo\Match;
use App\Duel;

class WarbandApiController extends Controller
{
    public function check(Request $request)
    {

        if(!$request->uid || !$request->username) return '-2';

       $user = User::find($request->uid);

       if(!$user) {

        $user = new User;

        $user->name = $request->username;
        $user->uid = $request->uid;
        $user->email = \Str::random(10).'@none.com';
        $pass = \Str::random(6);
        $user->password = bcrypt($pass);
        $user->secret_key = $pass;
        $user->save();

        return '1|' . $user->uid . '|' . $user->secret_key;
       } else if(!$user->active){
           return '2|'. $user->uid . '|' .$user->secret_key;
       } else {
           return '3|' . $user->uid . '|' . $user->elo;
       }

    }



    public function FT7(Request $request){

        if(!$request->winner_uid || !$request->loser_uid || !$request->winner_score || !$request->loser_score) return '-2| Wrong query';

        $winner = User::find($request->winner_uid);
        $loser = User::find($request->loser_uid);

        if(!$winner || !$loser) return '-3|One of participants doesnt have account';
        if(!$winner->active) return '-4|Winner of duel have inactive account';
        if(!$loser->active) return '-4|Loser of duel have inactive account';


        $winner_player = new Player($winner->elo);
        $loser_player = new Player($loser->elo);


        $match = new Match($winner_player, $loser_player);
$match->setScore($request->winner_score, $request->loser_score)
    ->setK(32)
    ->count();

    $winner_rating = $winner_player->getRating();
   $loser_rating = $loser_player->getRating();

if($loser_rating > $loser->elo) $loser_rating = $loser->elo;

     $duel = new Duel;
     $duel->winner_id = $winner->id;
     $duel->loser_id = $loser->id;
     $duel->winner_score = $request->winner_score;
     $duel->loser_score = $request->loser_score;
   





     if(abs($loser->elo - $loser_rating) < 1) $loser_rating--;
     if(abs($winner->elo - $winner_rating) < 1) $winner_rating++;
     

     $elo_plus = floor($winner_rating - $winner->elo);
    $elo_minus = floor($winner->elo - $winner_rating);


     $duel->winner_elo_plus = $elo_plus;
     $duel->loser_elo_minus = $elo_minus;
     $duel->save();


        $winner->elo = $winner_rating;
        $loser->elo = $loser_rating;
       $winner->increment('kills', $request->winner_score);
       $winner->increment('deaths', $request->loser_score);
       $loser->increment('kills', $request->loser_score);
       $loser->increment('deaths', $request->winner_score);
        $winner->save();
        $loser->save();

    return '5|' . $winner->uid . '|' . $loser->uid . '|' . $elo_plus . '|' . $elo_minus;


    }
}
