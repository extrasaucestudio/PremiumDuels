<?php

namespace App\Http\Controllers;

use App\user_special_titles;
use Illuminate\Http\Request;
use App\Special_Title;


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
}
