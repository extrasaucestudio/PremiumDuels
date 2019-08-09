<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolMember extends Model
{
    public function MemberToSchool()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }
}
