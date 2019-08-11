<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\UserItems;
use App\User;

class ItemController extends Controller
{
    public function display_create()
    {
        $user = auth()->user();
        return view('admin.Pages.item-create', compact('user'));
    }


    public function display_edit($id)
    {
        $user = auth()->user();

        $item = Item::find($id);
        if ($item == null)  return \Redirect::to('/admin');
        return view('admin.Pages.item-edit', compact('user', 'item'));
    }

    public function create(Request $request)
    {

        $validator = request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'game_id' => 'required|min:2',
            'name' => 'required|min:2|max:30',
            'type' =>
            array(
                'required',
                'regex:(helmet|body|gloves|boots|weapon)'
            )
        ]);

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/items'), $imageName);


        $item = new Item;
        $item->name = $request->name;
        $item->game_id = $request->game_id;
        $item->image = $imageName;
        $item->type = $request->type;
        $item->save();

        return redirect()->back()->with('success', 'Success. Item was created.');
    }


    public function edit(Request $request)
    {


        $validator = request()->validate([

            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'game_id' => 'required|min:2',
            'name' => 'required|min:2|max:30',
            'type' =>
            array(
                'required',
                'regex:(helmet|body|gloves|boots|weapon)'
            )


        ]);







        $item = Item::find($request->id);
        $item->name = $request->name;
        $item->game_id = $request->game_id;

        $item->type = $request->type;


        if ($request->image != null) {

            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images/items'), $imageName);

            $item->image = $imageName;
        }



        $item->save();

        return redirect()->back()->with('success', 'Success. Item was edited.');
    }

    public function display_give($id)
    {
        $user = auth()->user();
        $item = Item::find($id);
        if ($item == null) \Redirect::to('/');

        return view('admin.Pages.item-give', compact('user', 'item'));
    }


    public function give(Request $request)
    {
        $user = User::find($request->uid);

        if ($user == null)  return redirect()->back()->with('error', 'Failed. There is no such user with that uid.');

        $item = Item::find($request->itemID);

        if ($item == null)  return \Redirect::to('/');

        if (UserItems::where('user_id', $user->id)->Where('item_id', $item->id)->count() > 0) return redirect()->back()->with('error', 'Failed. User already have that item.');

        $UserItem = new UserItems;

        $UserItem->user_id = $user->id;
        $UserItem->item_id = $item->id;
        $UserItem->save();

        return \Redirect::to('/admin/items')->with('success', 'Success. Item was given.');
    }
}
