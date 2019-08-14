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


    protected $dispatchesEvents = [
        'created' => Events\NewUserEvent::class,
        'updated' => Events\UserUpdatedEvent::class
    ];

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
        'password', 'remember_token', 'secret_password'
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

    public function UserItems()
    {
        return $this->hasMany('App\UserItems', 'user_id', 'id');
    }

    public function School()
    {
        return $this->belongsTo('App\SchoolMember', 'id', 'user_id');
    }

    public function Invitations()
    {
        return $this->hasMany('App\School_Invite', 'user_id', 'id');
    }

    public function EloHistory()
    {
        return $this->hasMany('App\UserEloHistory', 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function Items()
    {
        return $this->hasMany('App\UserItems', 'user_id', 'id');
    }





    public function User_Helmets()
    {

        return $this->hasMany('App\UserItems', 'user_id', 'id')->whereHas('ItemData', function ($query) {
            $query->where('type', '=', 'helmet');
        });
    }
    public function User_Armors()
    {

        return $this->hasMany('App\UserItems', 'user_id', 'id')->whereHas('ItemData', function ($query) {
            $query->where('type', '=', 'armor');
        });
    }
    public function User_Boots()
    {

        return $this->hasMany('App\UserItems', 'user_id', 'id')->whereHas('ItemData', function ($query) {
            $query->where('type', '=', 'boots');
        });
    }

    public function User_Gloves()
    {

        return $this->hasMany('App\UserItems', 'user_id', 'id')->whereHas('ItemData', function ($query) {
            $query->where('type', '=', 'gloves');
        });
    }
    public function User_Weapons()
    {

        return $this->hasMany('App\UserItems', 'user_id', 'id')->whereHas('ItemData', function ($query) {
            $query->where('type', '=', 'weapon');
        });
    }

    public function Country()
    {
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }

    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }

    public function User_Helmet()
    {
        return $this->hasOne('App\UserItems', 'id', 'helmet');
    }

    public function User_Armor()
    {
        return $this->hasOne('App\UserItems', 'id', 'armor');
    }

    public function User_Glove()
    {
        return $this->hasOne('App\UserItems', 'id', 'gloves');
    }

    public function User_Boot()
    {
        return $this->hasOne('App\UserItems', 'id', 'boots');
    }

    public function User_Weapon()
    {
        return $this->hasOne('App\UserItems', 'id', 'weapon');
    }


    public function isChampion()
    {
        return $this->hasMany('App\user_special_titles', 'user_id', 'id')->where('special_title_id', 1);
    }
}
