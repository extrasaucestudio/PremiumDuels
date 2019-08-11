<?php

namespace App\Http\Controllers;

use App\School_Invite;
use Illuminate\Http\Request;
use App\User;
use App\School;

class SchoolInviteController extends Controller
{

    public function display_invite()
    {
        $user = auth()->user();
        $schools = School::all();
        if ($schools == null) \Redirect::to('/admin');
        return view('admin.Pages.school-invite', compact('user', 'schools'));
    }

    public function invite(Request $request)
    {
        $user = User::find($request->uid);
        if ($user == null)  return redirect()->back()->with('error', 'Failed. There is no such user with that uid.');
        if ($user->School != null) return redirect()->back()->with('error', 'Failed. This user is already in a guild.');
        $school = School::find($request->school_id);
        if ($school == null) return \Redirect::to('/');
        $invite = new School_Invite;
        $invite->inviter_id = auth()->user()->id;
        $invite->user_id = $user->id;
        $invite->school_id = $school->id;
        $invite->save();
        return \Redirect::to('/');
    }
}
