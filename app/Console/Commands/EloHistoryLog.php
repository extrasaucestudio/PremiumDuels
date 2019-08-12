<?php

namespace App\Console\Commands;

use App\User;
use App\UserEloHistory;
use Illuminate\Console\Command;

class EloHistoryLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EloHistoryLog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log User Elo Changes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $key => $user) {

            $eloLog = new UserEloHistory;
            $eloLog->user_id = $user->id;
            $eloLog->elo = $user->elo;
            $eloLog->save();
        }
    }
}
