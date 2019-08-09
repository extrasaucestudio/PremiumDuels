<?php

namespace App\Http\Controllers;

use App\UserItems;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Items;

class UserItemsController extends Controller
{
    public function display_switch()
    {

        $user = Auth::user();



        return view('user.pages.inventory-switch', compact('user'));
    }


    public function switch(Request $request)
    {

        $user = Auth::user();


        $helmet_ = UserItems::find($request->helmet);
        $armor_ = UserItems::find($request->armor);
        $gloves_ = UserItems::find($request->gloves);
        $boots_ = UserItems::find($request->boots);
        $weapon_ = UserItems::find($request->weapon);


        if ($helmet_ == null) {
            $user->helmet = null;
        } else if ($helmet_->user_id == $user->id) {
            $user->helmet = $helmet_->id;
        }


        if ($armor_ == null) {

            $user->armor = null;
        } else if ($armor_->user_id == $user->id) {
            $user->armor = $armor_->id;
        }


        if ($gloves_ == null) {
            $user->gloves = null;
        } else if ($gloves_->user_id == $user->id) {
            $user->gloves = $gloves_->id;
        }




        if ($boots_ == null) {
            $user->boots = null;
        } else if ($boots_->user_id == $user->id) {
            $user->boots = $boots_->id;
        }



        if ($weapon_ == null) {
            $user->weapon = null;
        } else if ($weapon_->user_id == $user->id) {
            $user->weapon = $weapon_->id;
        }

        $user->save();


        return redirect()->back()->with('success', 'Succes');
    }
}
