<?php

use Illuminate\Database\Seeder;
use App\SchoolMember;

class SchoolMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SchoolMember = new SchoolMember;
        $SchoolMember->user_id = 1;
        $SchoolMember->school_id = 1;
    
        $SchoolMember->save();
    }
}
