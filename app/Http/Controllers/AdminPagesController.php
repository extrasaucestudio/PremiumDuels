<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tournament;
use App\Item;



class AdminPagesController extends Controller
{

    public function elo_manipulation()
    {
        $user = auth()->user();
        return view('admin.elo_manipulation', compact('user'));
    }
    public function currency_manipulation()
    {

        $user = auth()->user();
        return view('admin.currency_manipulation', compact('user'));
    }
    public function user_list()
    {

        $user = auth()->user();
        $users = User::all();

        return view('admin.user_list', compact('user', 'users'));
    }


    public function CreateTournament()
    {
        $user = auth()->user();
        return view('admin.Pages.tournament-create', compact('user'));
    }

    public function EditTournament($id)
    {
        $user = auth()->user();
        $tournament = Tournament::find($id);
        if (!$tournament)  return redirect()->back();

        return view('admin.Pages.tournament-edit', compact('user', 'tournament'));
    }

    public function View_Tournaments()
    {
        $user = auth()->user();
        $tournaments = Tournament::orderBy('created_at', 'DESC')->get();
        return view('admin.Pages.view-tournaments', compact('user', 'tournaments'));
    }

    public function View_Items()
    {
        $user = auth()->user();
        $items = Item::orderBy('created_at', 'DESC')->get();
        return view('admin.Pages.view-items', compact('user', 'items'));
    }
}
