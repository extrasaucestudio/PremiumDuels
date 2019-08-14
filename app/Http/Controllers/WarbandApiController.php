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

        if (!$request->uid || !$request->username) return '1|-2| Wrong query';

        $user = User::find($request->uid);

        if (!$user) {

            $user = new User;

            $user->name = $request->username;
            $user->uid = $request->uid;
            $user->email = \Str::random(10) . '@none.com';
            $pass = \Str::random(6);
            $user->password = bcrypt($pass);
            $user->secret_key = $pass;
            $user->save();

            return "1|1|{$request->player_id}|{$request->uid}|{$user->secret_key}";
        } else if (!$user->active) {
            $user->touch();

            return "1|2|{$request->player_id}|{$user->uid}|{$user->secret_key}";
        } else {

            $helmet = $user->User_Helmet->ItemData->game_id ?? -1;
            $gloves = $user->User_Glove->ItemData->game_id ?? -1;
            $boots = $user->User_Boot->ItemData->game_id ?? -1;  /// itm_ankle_boots = 170
            $weapon = $user->User_Weapon->ItemData->game_id ?? -1;
            $armor = $user->User_Armor->ItemData->game_id ?? -1;




            $user->touch();
            $resp = "|1|3|{$request->player_id}|{$user->uid}|{$user->secret_key}|{$user->elo}|{$helmet}|{$armor}|{$gloves}|{$boots}|{$weapon}|Joining message string there|";

            return;
        }
    }



    public function FT7(Request $request)
    {

        if ($request->winner_uid == null || $request->loser_uid == null || $request->winner_score == null || $request->loser_score == null) return '2|-2| Wrong query';

        $winner = User::find($request->winner_uid);
        $loser = User::find($request->loser_uid);

        if (!$winner || !$loser) return "2|-3|{$request->winner_id}|{$request->loser_id}|One of participants doesnt have account";
        if (!$winner->active) return "2|-4|{$request->winner_id}|{$request->loser_id}|Winner of duel have inactive account";
        if (!$loser->active) return "2|-6|{$request->winner_id}|{$request->loser_id}|Loser of duel have inactive account";


        $winner_player = new Player($winner->elo);
        $loser_player = new Player($loser->elo);


        $match = new Match($winner_player, $loser_player);
        $match->setScore($request->winner_score, $request->loser_score)
            ->setK(32)
            ->count();

        $winner_rating = $winner_player->getRating();
        $loser_rating = $loser_player->getRating();

        if ($loser_rating > $loser->elo) $loser_rating = $loser->elo;

        $duel = new Duel;
        $duel->winner_id = $winner->id;
        $duel->loser_id = $loser->id;
        $duel->winner_score = $request->winner_score;
        $duel->loser_score = $request->loser_score;






        if (abs($loser->elo - $loser_rating) < 1) $loser_rating--;
        if (abs($winner->elo - $winner_rating) < 1) $winner_rating++;


        $elo_plus = floor($winner_rating - $winner->elo);
        $elo_minus = floor($winner->elo - $winner_rating);


        $duel->winner_elo_plus = $elo_plus;
        $duel->loser_elo_minus = $elo_minus;
        $duel->save();


        $winner->elo = floor($winner_rating);
        $loser->elo = floor($loser_rating);
        $winner->increment('kills', $request->winner_score);
        $winner->increment('deaths', $request->loser_score);
        $loser->increment('kills', $request->loser_score);
        $loser->increment('deaths', $request->winner_score);
        $winner->save();
        $loser->save();

        $winner->touch();
        $loser->touch();



        return "2|5|{$request->winner_id}|{$request->loser_id}|{$winner->uid}|{$loser->uid}|{$elo_plus}|{$elo_minus}|{$winner->elo}|{$loser->elo}";
    }
}
