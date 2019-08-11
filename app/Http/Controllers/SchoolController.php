<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use App\User;
use App\SchoolMember;


class SchoolController extends Controller
{
    public function display_create()
    {

        $user = auth()->user();
        return view('admin.Pages.school-create', compact('user'));
    }
    public function create(Request $request)
    {



        $validator = request()->validate([

            'name' => 'required|min:2|max:30',
        ]);

        $user = User::find($request->uid);

        if ($user == null)  return redirect()->back()->with('error', 'Failed. There is no such user with that uid.');
        if ($user->School != null) return redirect()->back()->with('error', 'Failed. This user is already in a guild.');


        if (School::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. School with that name already exist.');

        $school = new School;
        $school->name = $request->name;
        $school->owner_id = $user->id;
        $school->save();


        $schoolMember = new SchoolMember;
        $schoolMember->school_id = $school->id;
        $schoolMember->user_id = $user->id;
        $schoolMember->save();

        return \Redirect::to('/admin');
    }

    public function view_schools()
    {
        $user = auth()->user();

        $schools = School::all();
        return view('admin.Pages.view-schools', compact('user', 'schools'));
    }

    public function display_edit($id)
    {
        $user = auth()->user();
        $school = School::find($id);
        if ($school == null) \Redirect::to('/admin');
        return view('admin.Pages.school-edit', compact('user', 'school'));
    }

    public function edit(Request $request)
    {
        $validator = request()->validate([

            'name' => 'required|min:2|max:30',
        ]);

        $user = User::find($request->uid);


        if ($user == null)  return redirect()->back()->with('error', 'Failed. There is no such user with that uid.');



        if (School::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. School with that name already exist.');

        $school = School::find($request->school_id);

        if ($user->School != null && $request->uid != $school->SchoolOwner->uid) return redirect()->back()->with('error', 'Failed. This user is already in a guild.');

        $oldOwner = $school->owner_id;

        $school->name = $request->name;
        $school->owner_id = $user->id;
        $school->save();


        $schoolMember = SchoolMember::Where('user_id', $oldOwner)->Where('school_id', $school->id)->first();
        $schoolMember->school_id = $school->id;
        $schoolMember->user_id = $user->id;
        $schoolMember->save();

        return \Redirect::to('/admin');
    }
}
