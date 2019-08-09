<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserItems extends Model
{
    public function ItemData()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
}
