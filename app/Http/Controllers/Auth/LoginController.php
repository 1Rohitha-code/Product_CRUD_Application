<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {
        if(Auth::user()->user_type == 'admin')
        {
            return redirect('/admin_dashboard')->with('status','Welcome to Dashboard');
        }
        //normal user login
        elseif(Auth::user()->user_type== NULL)
        {
            return redirect('/customer_dashboard')->with('status','You are logged in successfully!');
        }
        else{
            return redirect('/warning')->with('status','You are not allowed to this route!');
        }
      
    }
}
