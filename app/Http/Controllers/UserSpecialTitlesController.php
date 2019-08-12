<?php

namespace App\Http\Controllers;

use App\user_special_titles;
use Illuminate\Http\Request;
use App\Special_Title;
use App\SchoolMember;
use App\User;
use App\School;
use App\UserItems;


class UserSpecialTitlesController extends Controller
{
    public function change(Request $request)
    {


        $user = \Auth::user();

        if ($request->title == 'none') {

            $user->special_title_id = null;

            $user->save();
        } else {

            $exist = user_special_titles::where('id', $request->title)->where('user_id', $user->id)->first();
            if (!$exist)  return redirect()->back();

            $user->special_title_id = $exist->id;
            $user->save();
        }


        if ($request->title == 'none') {
            return redirect()->back()->with('success', 'You have select your title as blank!');
        } else {
            return redirect()->back()->with('success', 'You have been switched title to <b>' . $exist->SpecialTitleData->name . '</b>!');
        }
    }


    public function ChangeChampion(Request $request)
    {
        $NewChampion = User::find($request->uid);


        if($NewChampion == null) return redirect()->back()->with('error', 'User with that uid doesnt exist!');
        if($NewChampion->School != null) return redirect()->back()->with('error', 'User is already member of school!');
        

        $ChampionTitle = user_special_titles::Where('special_title_id', 1)->first();
        $Old_Champion = User::find($ChampionTitle->SpecialTitleOwner->uid);

           
        if($Old_Champion->special_title_id == $ChampionTitle->id) $Old_Champion->special_title_id == null;
        $ChampionTitle->user_id = $NewChampion->id;


    

        foreach ($Old_Champion->UserItems->where('from_school', true) as $key => $item) {
            $item->delete();
        }


        foreach ($NewChampion->UserItems->where('from_school', true) as $key => $item) {
            $item->delete();
        }

        $school = School::find(1);


        $Old_Champion_SchoolMember = SchoolMember::where('school_id', 1)->Where('user_id', $Old_Champion->id)->first();

        
        $Old_Champion_SchoolMember->user_id = $NewChampion->id;
        $Old_Champion_SchoolMember->save();


        $gloves = new UserItems;
        $gloves->user_id = $NewChampion->id;
        $gloves->item_id = $school->extra_gloves_id;
        $gloves->from_school = true;
        $gloves->save();

        $boots = new UserItems;
        $boots->user_id = $NewChampion->id;
        $boots->item_id = $school->extra_boots_id;
        $boots->from_school = true;
        $boots->save();

        $ChampionTitle->save();
        $Old_Champion->save();
        return redirect()->back()->with('success', 'Success!!!!');

    }

    public function ChangeChampion_display()
    {
        $user = \Auth::user();

        return view('admin.change-champion', compact('user'));
    }
}
