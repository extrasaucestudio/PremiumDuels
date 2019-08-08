<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function SchoolOwner()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }
}
