<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Duel;
use stdClass;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::first();
        $Users = User::all();
        $NewUsersWeekly = User::where('created_at', '>=', new \DateTime('-1 week'))->count();
        $DuelsWeekly = Duel::where('created_at', '>=', new \DateTime('-1 week'))->count();
        $DuelWeekArrayGraph = array();
        $UserWeekArrayGraph = array();


        for ($x = 0; $x <= 6; $x++) {

            array_push($DuelWeekArrayGraph, Duel::whereDate('created_at', new \DateTime('-' . $x .  'day'))->orderBy('created_at', 'DESC')->count());
            array_push($UserWeekArrayGraph, User::whereDate('created_at', new \DateTime('-' . $x .  'day'))->orderBy('created_at', 'DESC')->count());
        }


        $AccountTypes = new stdClass;
        $AccountTypes->registered = User::where('active', 0)->count();
        $AccountTypes->active = User::where('active', 1)->Where('golden_account', 0)->count();
        $AccountTypes->golden = User::where('golden_account', 1)->count();






        return view('admin.index', compact('Users', 'user', 'NewUsersWeekly', 'DuelsWeekly', 'DuelWeekArrayGraph', 'AccountTypes', 'UserWeekArrayGraph'));
    }














    public function ChangeElo(Request $request)
    {
        $user = User::find($request->uid);
        if (!$user) return redirect()->back()->with('error', 'Failed. User with that uuid doesnt exist in our database.');
        if ($user->active == 0)  return redirect()->back()->with('error', 'Failed. User is not activated.');
        if ($request->value < 1)  return redirect()->back()->with('error', 'Failed. Value must be more than 0.');
        if ($user->value > 1000) return redirect()->back()->with('error', 'Failed. Value must be less than 0.');

        if ($request->action_type == 'add') {
            $user->increment('elo', $request->value);
        } else if ($request->action_type == 'substract') {
            $user->decrement('elo', $request->value);
            if (($user->elo - $request->value) < 0) return redirect()->back()->with('error', 'Failed. User doesnt have enought elo.');
        }
        $user->save();

        return redirect()->back()->with('success', "Success. Updated elo for <b> $user->name </b>");
    }

    public function ChangeCurrency(Request $request)
    {
        $user = User::find($request->uid);
        if (!$user) return redirect()->back()->with('error', 'Failed. User with that uuid doesnt exist in our database.');
        if ($user->active == 0)  return redirect()->back()->with('error', 'Failed. User is not activated.');
        if ($request->value < 1)  return redirect()->back()->with('error', 'Failed. Value must be more than 0.');

        if ($request->action_type == 'add') {
            $user->increment('currency', $request->value);
        } else if ($request->action_type == 'substract') {
            $user->decrement('currency', $request->value);
        }
        $user->save();

        return redirect()->back()->with('success', "Success. Updated currency for <b> $user->name </b>");
    }
}
