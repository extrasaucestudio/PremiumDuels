<?php

namespace App\Listeners;

use App\Events\NewUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeedUserDataListener
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
     * @param  NewUserEvent  $event
     * @return void
     */
    public function handle(NewUserEvent $event)
    {

        $id = $event->user->getKey();
        for ($i = 1; $i < 10; $i++) {

            \DB::table('user_elo_histories')->insert([
                'elo' => 1000,
                'user_id' => $id,
                'created_at' => new \DateTime("-{$i} day"),

            ]);
        }
    }
}
