<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function SchoolOwner()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    public function Members()
    {
        return $this->hasMany('App\SchoolMember', 'school_id', 'id');
    }

    public function SpecialTitle()
    {
        return $this->belongsTo('App\Special_Title', 'special_title_id', 'id');
    }
}
