<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;



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
}
