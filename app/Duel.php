<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    public function Duel_winner()
    {
        return $this->hasOne('App\User', 'id', 'winner_id');
    }
    public function Duel_loser()
    {
        return $this->hasOne('App\User', 'id', 'loser_id');
    }
}
