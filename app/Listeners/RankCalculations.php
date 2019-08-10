<?php

namespace App\Listeners;

use App\Title;
use App\Events\UserUpdatedEvent;

class RankCalculations
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {
        $user = $event->user;


        $newRank = Title::where('elo', '<=', $user->elo)->orderBy('elo', 'DESC')->first();



        if ($newRank != null && $newRank->id != $user->Title->id) {
            $user->title_id = $newRank->id;
            $user->saveQuietly();
            return;
        } else if ($user->Title->elo > $user->elo) {
            $newRank = Title::where('elo', '<', $user->Title->elo)->orderBy('elo', 'DESC')->first();
            if ($newRank == null) return;
            $user->title_id = $newRank->id;
            $user->saveQuietly();
            return;
        }


        return;
    }
}
