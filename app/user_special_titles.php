<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_special_titles extends Model
{

    public function SpecialTitleData()
    {
        return $this->belongsTo('App\Special_Title', 'special_title_id', 'id');
    }
}
