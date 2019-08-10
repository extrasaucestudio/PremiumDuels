<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use Auth;
use App\SchoolMember;
use Illuminate\Support\Facades\Redirect;

class UserSchoolControler extends Controller
{

    public function create_display()
    {


        $user = Auth::user();

        if ($user->School != null) return \Redirect::to('/home');
        return view('user.pages.school-create', compact('user'));
    }


    public function create(Request $request)
    {





        $validator = request()->validate([

            'name' => 'required|min:2|max:30',
        ]);

        $user = Auth::user();


        if ($user->School != null) return redirect()->back()->with('error', 'Failed. You are already in the school');


        if (School::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. School with that name already exist.');

        $school = new School;
        $school->name = $request->name;
        $school->owner_id = $user->id;
        $school->save();


        $schoolMember = new SchoolMember;
        $schoolMember->school_id = $school->id;
        $schoolMember->user_id = $user->id;
        $schoolMember->save();

        return \Redirect::to('/home');
    }


    public function display($schoolID = -1)
    {
        $user = Auth::user();

        if ($user->School == null) return Redirect::to('/home');

        if ($schoolID = -1) {
            $school = $user->School->MemberToSchool;
        } else {
            $school = School::find($schoolID);
        }



        return view('user.pages.school-view', compact('user', 'school'));
    }


    public function display_panel()
    {
        $user = Auth::user();

        if ($user->School == null) return Redirect::to('/home');
        if ($user->School->MemberToSchool->SchoolOwner->id != $user->id) Redirect::to('/home');


        $school = $user->School->MemberToSchool;


        $titles = array();

        foreach ($school->Members as $key => $Member) {
            foreach ($Member->User->SpecialTitles as $key => $title) {

                array_push($titles, $title);
            }
        }




        return view('user.pages.school-panel', compact('user', 'school', 'titles'));
    }


    public function edit_school(Request $request)
    {
        $validator = request()->validate([


            'body' => 'required|min:5',
            'schoolTitle_id' => 'required|integer',


        ]);
        $check = false;

        $user = auth()->user();

        if ($user->School == null) return Redirect::to('/home');

        if ($user->School->MemberToSchool->SchoolOwner->id != $user->id) return Redirect::to('/home');
        $school = $user->School->MemberToSchool;

        foreach ($school->Members as $key => $Member) {
            foreach ($Member->User->SpecialTitles as $key => $title) {

                if ($check == true) break;
                if ($title->id == $request->schoolTitle_id) $check = true;
            }
        }


        if ($check == false) return Redirect::to('/home');


        $school->body = $request->body;
        $school->special_title_id = $request->schoolTitle_id;
        $school->save();

        return Redirect::to('/user/school/view');
    }
}
