<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Country;
use App\User;
use App\School;

class CalculateElo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elo:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates elo for Schools and Countries.';

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

        $users = User::where('active', true)->get();

        function CountryElo($users)
        {
            \DB::table('countries')->update(['elo' => 0, 'members_num' => 0]);

            foreach ($users as $key => $user) {
                if ($user->Country == null) continue;
                $user->Country->increment('elo', $user->elo);
                $user->Country->increment('members_num', 1);
                $user->Country->save();
            }

            $countries =  Country::all();


            foreach ($countries as $key => $country) {
                if ($country->members_num == 0) continue;
                $country->elo = ($country->elo / $country->members_num);
                $country->save();
            }
        }


        function SchoolElo($users)
        {
            \DB::table('schools')->update(['elo' => 0]);



            $schools = School::all();

            foreach ($schools as $key => $school) {

                foreach ($school->Members as $key => $member) {
                    $school->increment('elo', $member->User->elo);
                    $school->save();
                }
            }


            foreach ($schools as $key => $school) {
                if ($school->Members->count() == 0) continue;
                $school->elo = ($school->elo / $school->Members->count());
                $school->save();
            }
        }

        CountryElo($users);
        SchoolElo($users);

        $this->info('Done');
    }
}
