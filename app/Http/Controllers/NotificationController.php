<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Illuminate\Notifications\DatabaseNotification;
use Auth;

class NotificationController extends Controller
{
    public function display($id)
    {
        $user = Auth::user();

        $notification = $user->notifications->where('id', $id)->where('notifiable_id', $user->uid)->first();

        $notification->markasread();

        return view('user.notification-layouts.notification-school-invite', compact('user', 'notification'));
    }
}
