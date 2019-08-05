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

            $exist = user_special_titles::find($request->title);
            if (!$exist)  return redirect()->back();

            $user->special_title_id = $exist->id;
            $user->save();
        }



        return redirect()->back();
    }
}
