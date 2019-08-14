<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use Auth;
use App\SchoolMember;
use App\user_special_titles;
use App\School_Invite;
use Illuminate\Support\Facades\Redirect;
use stdClass;
use App\Item;
use App\UserItems;
use App\Notifications\NewSchoolInvite;

class UserSchoolControler extends Controller
{

    public function create_display()
    {


        $user = Auth::user();

        if ($user->School != null) return \Redirect::to('/home');

        $gloves = Item::where('type', 'gloves')->get();

        $boots = Item::where('type', 'boots')->get();


        return view('user.pages.school-create', compact('user', 'gloves', 'boots'));
    }


    public function create(Request $request)
    {





        $validator = request()->validate([

            'name' => 'required|min:2|max:30',
        ]);

        $user = Auth::user();


        $boots = Item::find($request->boots_id);
        $gloves = Item::find($request->gloves_id);


        if ($boots->type != 'boots' || $gloves->type != 'gloves') return redirect()->back()->with('error', 'Fatal error. Wrong item');

        if ($user->School != null) return redirect()->back()->with('error', 'Failed. You are already in the school');


        if (School::where('name', $request->name)->count() > 0) return redirect()->back()->with('error', 'Failed. School with that name already exist.');



        if ($user->currency < 15000)  return redirect()->back()->with('error', 'Failed. You do not have enought money!');

        $school = new School;
        $school->name = $request->name;
        $school->owner_id = $user->id;
        $school->extra_gloves_id = $gloves->id;
        $school->extra_boots_id = $boots->id;
        $school->save();


        $schoolMember = new SchoolMember;
        $schoolMember->school_id = $school->id;
        $schoolMember->user_id = $user->id;
        $schoolMember->save();


        $gloves = new UserItems;
        $gloves->user_id = $user->id;
        $gloves->item_id = $school->extra_gloves_id;
        $gloves->from_school = true;
        $gloves->save();



        $boots = new UserItems;
        $boots->user_id = $user->id;
        $boots->item_id = $school->extra_boots_id;
        $boots->from_school = true;
        $boots->save();


        $user->decrement('currency', 15000);
        $user->save();

        return \Redirect::to('/home');
    }


    public function display($schoolID = null)
    {
        $user = Auth::user();
        $Addionaldata = new stdClass;


        $Addionaldata->GoldSchool = 0;
        if ($schoolID == null) {

            if ($user->School == null) {
                return Redirect::to('/home');
            } else if ($user->School->id == 1 && user_special_titles::where('special_title_id', 1)->count() == 0) { } else if ($user->School->MemberToSchool->id == 1) {
                $ChampionOwner = user_special_titles::where('special_title_id', 1)->first();

                $Addionaldata->GoldSchool = 1;
                $Addionaldata->Owner = $ChampionOwner->SpecialTitleOwner->name;
                $Addionaldata->Owner_uid = $ChampionOwner->SpecialTitleOwner->uid;
            }

            $school = $user->School->MemberToSchool;
        } else {

            $school = School::find($schoolID);

            if ($school == null) {
                dd(3);
                return Redirect::to('/home');
            } else if ($school->id == 1 && user_special_titles::where('special_title_id', 1)->count() == 0) {

                return Redirect::to('/home');
            } else if ($school->id == 1) {
                $ChampionOwner = user_special_titles::where('special_title_id', 1)->first();
                $Addionaldata->GoldSchool = 1;
                $Addionaldata->Owner = $ChampionOwner->SpecialTitleOwner->name;
                $Addionaldata->Owner_uid = $ChampionOwner->SpecialTitleOwner->uid;
            }
        }


        if ($schoolID == null) {
            //// Empty school ID
            if ($user->School == null) return Redirect::to('/home');

            $school = $user->School->MemberToSchool;
        }



        return view('user.pages.school-view', compact('user', 'school', 'Addionaldata'));
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


    public function join_school(Request $request)
    {
        $user = Auth::user();



        $invite = School_Invite::find($request->invite_id);

        if ($invite == null)   return \Redirect::to('/home');

        $school = School::find($invite->school_id);


        if ($invite->user_id != $user->id || $user->School != null || $school == null)  return \Redirect::to('/home');


        if (SchoolMember::where('school_id', $school->id)->count() >= $school->capacity)  return \Redirect::to('/home');



        $SchoolMember = new SchoolMember;
        $SchoolMember->school_id = $invite->school_id;
        $SchoolMember->user_id = $user->id;
        $SchoolMember->save();

        $invite->delete();





        $boots = new UserItems;
        $boots->user_id = $user->id;
        $boots->item_id = $school->extra_boots_id;
        $boots->from_school = true;
        $boots->save();


        return \Redirect::to('/school');
    }


    public function reject_school(Request $request)
    {
        $user = Auth::user();

        $invite = School_Invite::find($request->invite_id);

        if ($invite == null || $invite->user_id != $user->id)  return \Redirect::to('/home');

        $invite->delete();

        return \Redirect::to('/home');
    }

    public function leave_school(Request $request)
    {
        $user = Auth::user();

        if ($user->isChampion->count() > 0) return \Redirect::to('/home');

        if ($user->School == null) return \Redirect::to('/home');

        if ($user->School->MemberToSchool->owner_id == $user->id) return \Redirect::to('/home');

        $schoolMember = SchoolMember::where('user_id', $user->id)->first();

        if ($schoolMember == null) return \Redirect::to('/home');

        $schoolMember->delete();

        $UserItemsToDelete = $user->UserItems->where('from_school', true);

        foreach ($UserItemsToDelete as $key => $item) {
            $item->delete();
        }
        return \Redirect::to('/home');
    }

    public function invite_to_school(Request $request)
    {
        $user = Auth::user();
        $foreign_user = User::find($request->foreign_user_uid);

        if ($user->School == null || $foreign_user == null || $foreign_user->School != null || $user->School->MemberToSchool->owner_id != $user->id) return \Redirect::to('/home');

        if ($user->School->MemberToSchool->Members->count() >= $user->School->MemberToSchool->capacity) return \Redirect::to('/home');

        $invite = new School_Invite;
        $invite->inviter_id = $user->id;
        $invite->school_id = $user->School->MemberToSchool->id;
        $invite->user_id = $foreign_user->id;
        $invite->save();


        $foreign_user->notify(new NewSchoolInvite($foreign_user, $user->School->MemberToSchool, $invite));

        return \Redirect::to('/home');
    }
}
