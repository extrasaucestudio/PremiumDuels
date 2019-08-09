<?php

namespace App\Http\Controllers;

use App\Special_Title;
use Illuminate\Http\Request;
use App\User;
use \Auth;
use App\user_special_titles;

class SpecialTitleController extends Controller
{
    public function display_create()
    {

        $user = Auth::user();
        return view('user.pages.title-create', compact('user'));
    }

    public function display_switch()
    {

        $user = Auth::user();
        return view('user.pages.title-switch', compact('user'));
    }


    public function create(Request $request)
    {
        $validator = request()->validate([

            'name' => 'required|min:3|max:12',
        ]);

        $user = Auth::user();

        if (Special_Title::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. Title with that name already exist.');

        if ($user->currency < 500)  return redirect()->back()->with('error', 'Failed. You do not have enought money!');

        $SpecialTitle = new Special_Title;
        $SpecialTitle->name = $request->name;
        $SpecialTitle->class = 'minor';
        $SpecialTitle->save();

        $UserSpecialTitle = new user_special_titles;
        $UserSpecialTitle->special_title_id = $SpecialTitle->id;
        $UserSpecialTitle->user_id = $user->id;
        $UserSpecialTitle->save();

        $user->decrement('currency', 500);
        $user->save();

        return redirect()->back()->with('success', 'Success. You have been created new minor title.');
    }
}
