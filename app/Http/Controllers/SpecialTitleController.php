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
        return view('admin.Pages.title-create', compact('user'));
    }

    public function display_switch()
    {

        $user = Auth::user();
        return view('user.pages.title-switch', compact('user'));
    }


    public function create(Request $request)
    {
        $validator = request()->validate([

            'name' => 'required|min:3|max:25',
        ]);

        $user = Auth::user();

        if (Special_Title::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. Title with that name already exist.');



        $SpecialTitle = new Special_Title;
        $SpecialTitle->name = $request->name;
        $SpecialTitle->class = 'minor';
        $SpecialTitle->save();

        $UserSpecialTitle = new user_special_titles;
        $UserSpecialTitle->special_title_id = $SpecialTitle->id;
        $UserSpecialTitle->user_id = $user->id;
        $UserSpecialTitle->save();

        $user->save();

        return redirect()->back()->with('success', 'Success. You have been created new minor title.');
    }

    public function display_give()
    {
        $user = Auth::user();
        $titles = Special_Title::where('name', '!=', 'Champion')->get();


        return view('admin.Pages.title-give', compact('user', 'titles'));
    }


    public function give(Request $request)
    {

        $user = User::find($request->user_uid);
        $SpecialTitle = Special_Title::find($request->title_id);

        if ($user == null) return redirect()->back()->with('error', 'There is no such user with this uid.');
        if ($SpecialTitle == null) return redirect()->back()->with('error', 'Something went wrong...');
        if ($SpecialTitle->name == 'Champion') return redirect()->back()->with('error', 'There can be only one champion.');


        if ($user->SpecialTitles->where('special_title_id', $SpecialTitle->id)->count() > 0) return redirect()->back()->with('error', 'User already have that title!');

        $UserSpecialTitle = new user_special_titles;
        $UserSpecialTitle->special_title_id = $SpecialTitle->id;
        $UserSpecialTitle->user_id = $user->id;
        $UserSpecialTitle->save();


        return \Redirect::to('/admin');
    }
}
