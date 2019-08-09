<?php

namespace App\Http\Controllers;

use App\Duel;
use Illuminate\Http\Request;
use Auth;

class DuelController extends Controller
{
    public function DuelHistory()
    {
        $user = Auth::user();
        $LastDuels = Duel::Where('winner_id', $user->id)->orWhere('loser_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('user.pages.duel-history', compact('user', 'LastDuels'));
    }
}
