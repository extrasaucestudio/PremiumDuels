<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class AdminApiController extends Controller
{
    public function CreateTournament(Request $request)
    {

        $validator = request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|min:5',
            'title' => 'required|min:5|max:30',


        ]);



        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/assets'), $imageName);

        $user = auth()->user();

        $tournament = new Tournament;
        $tournament->title = $request->title;
        $tournament->body = $request->body;
        $tournament->image = '/images/assets/' . $imageName;
        $tournament->creator_id = $user->id;
        $tournament->save();

        return redirect()->back()->with('success', 'Success. Tournament was created. You can view it at <b><a href="/tournament/' . $tournament->id . '">here</a></b>');
    }


    public function EditTournament(Request $request)
    {

        $validator = request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required|min:5',
            'title' => 'required|min:5|max:30',


        ]);

        $user = auth()->user();

        $tournament = Tournament::find($request->TournamentID);
        $tournament->title = $request->title;
        $tournament->body = $request->body;

        if ($request->image != null) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/assets'), $imageName);
            $tournament->image = '/images/assets/' . $imageName;
        }

        $tournament->creator_id = $user->id;
        $tournament->save();

        return redirect()->back()->with('success', 'Success. Tournament was edited. You can view it at <b><a href="/tournament/' . $tournament->id . '">here</a></b>');
    }


    public function DeleteTournament(Request $request)
    {
        $tournament = Tournament::find($request->id);
        $tournament->delete();
    }

    public function UpdateTournamentState(Request $request)
    {
        $tournament = Tournament::find($request->id);


        if ($tournament->state == 'awaiting') {
            $tournament->state = 'ongoing';
        } else if ($tournament->state == 'ongoing') {
            $tournament->state = 'finished';
        }

        $tournament->save();
    }
}
