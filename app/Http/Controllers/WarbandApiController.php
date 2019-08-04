<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class WarbandApiController extends Controller
{
    public function check(Request $request)
    {

        if(!$request->uid || !$request->username) return '-2';

       $user = User::find($request->uid);

       if(!$user) {

        $user = new User;

        $user->name = $request->username;
        $user->uid = $request->uid;
        $user->email = \Str::random(10).'@none.com';
        $pass = \Str::random(6);
        $user->password = bcrypt($pass);
        $user->secret_key = $pass;
        $user->save();

        return '1|' . $user->uid . '|' . $user->secret_key;
       } else if(!$user->active){
           return '2|'. $user->uid . '|' .$user->secret_key;
       } else {
           return '3|' . $user->uid . '|' . $user->elo;
       }

    }
}
