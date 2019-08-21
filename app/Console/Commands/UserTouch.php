<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UserTouch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:touch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'touch all users';

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

        foreach ($users as $user) {
            $user->touch();
        }
    }
}
