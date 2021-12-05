<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

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
        $this->middleware(['guest'])->except('logout');
    }

    public function login(Request $request){


        $host = $request->getHttpHost();
        $ex = explode('.',$host);
        $domain = $ex[0];

        @$remember = $request->remember;
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], ($remember == 'on') ? true : false)){
            if(auth()->user()->domain != $domain){
                Auth::logout();
                return __('There is a problem with the email or password');
            }
            return "success";
        }

        return __('There is a problem with the email or password');

    }

    public function workspace(){
        return view('auth.loginDomain');
    }

    public function checkdomain(Request $request){
        $domain = User::where('domain',$request->domain)->first();
        if($domain){
            return $domain;
        }
        
        return "error";
    }

}
