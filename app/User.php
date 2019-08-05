<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Duel;

class User extends Authenticatable
{
    use Notifiable;


    protected $primaryKey = 'uid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Title()
    {
        return $this->belongsTo('App\Title', 'title_id', 'id');
    }

    public function DuelsWon()
    {
        return $this->hasMany('App\Duel', 'winner_id', 'id');
    }



    public function DuelsLosed()
    {
        return $this->hasMany('App\Duel', 'loser_id', 'id');
    }

    public function SpecialTitles()
    {
        return $this->hasMany('App\user_special_titles', 'user_id', 'id');
    }

    public function SpecialTitle()
    {
        return $this->belongsTo('App\user_special_titles', 'special_title_id', 'id');
    }
}
