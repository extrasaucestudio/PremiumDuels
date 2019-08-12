<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Country;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return "uid";
    }



    protected function authenticated($request, $user)
    {
        if ($user->active == false) {
            $geolocation = geoip($request->ip);
            $user->active = true;
            $country = Country::where('name', $geolocation->getLocation()->country)->first();

            if ($country == null) {
                $country = new Country;
                $country->name = $geolocation->getLocation()->country;
                $country->country_code = strtolower($geolocation->getLocation()->iso_code);
                $country->save();
            }
            $user->country_id = $country->id;
        }
        $user->ip = $request->ip;
        $user->save();

    }
}
