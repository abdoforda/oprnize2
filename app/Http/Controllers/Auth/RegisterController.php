<?php

namespace App\Http\Controllers\Auth;

use App\Allowance;
use App\Company;
use App\Http\Controllers\Controller;
use App\Mail\Password;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Vacation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/login";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'domain' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $pass = Str::random(8);
        $user = User::create([
            'name' => "Demo",
            'email' => $data['email'],
            'domain' => $data['domain'],
            'password' => Hash::make($pass)
        ]);

        $email = [
            'domain' => $data['domain'],
            'email' => $data['email'],
            'pass' => $pass,
        ];

        Mail::to($data['email'])->send(new Password($email));
        return  $user;

    }

    public function register(Request $request){


        $request->validate([
            'domain' => ['required', 'string', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u', 'max:255', 'unique:users'],
            'email' => ['required', 'string','email', 'max:255', 'unique:users']
        ]);

        $pass = Str::random(8);
        $user = User::create([
            'name' => "Demo",
            'email' => $request->email,
            'domain' => strtolower($request->domain),
            'password' => Hash::make($pass),
            'change_password' => true
        ]);

        $company = new Company();
        $company->domain = strtolower($request->domain);
        $company->user_id = $user->id;
        $company->save();

        $user->company_id = $company->id;
        $user->save();

        

        
        $data2 = [
            ['company_id'=>$company->id, 'name_en'=> 'Preliminary sick leave','name_ar'=> '?????????? ?????????? ????????','min'=> 1,'max'=> 30,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'Second sick leave','name_ar'=> '?????????? ?????????? ??????????','min'=> 1,'max'=> 60,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'Third sick leave','name_ar'=> '?????????? ?????????? ??????????','min'=> 1,'max'=> 30,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'Annual','name_ar'=> '??????????','min'=> 10,'max'=> 21,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'death','name_ar'=> '????????','min'=> 1,'max'=> 5,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'marriage','name_ar'=> '????????','min'=> 0,'max'=> 0,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'born','name_ar'=> '??????????','min'=> 0,'max'=> 0,'type'=> 'male'],
            ['company_id'=>$company->id, 'name_en'=> 'Perform the Hajj','name_ar'=> '???????? ?????????? ????????','min'=> 0,'max'=> 0,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'Take the exams','name_ar'=> '???????? ????????????????????','min'=> 0,'max'=> 0,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'Unpaid leave','name_ar'=> '?????????? ???????? ??????','min'=> 10,'max'=> 20,'type'=> 'all'],
            ['company_id'=>$company->id, 'name_en'=> 'procreation','name_ar'=> '??????','min'=> 0,'max'=> 0,'type'=> 'female'],
            ['company_id'=>$company->id, 'name_en'=> 'counting','name_ar'=> '??????????','min'=> 0,'max'=> 0,'type'=> 'female'],
            //...
        ]; Vacation::insert($data2);

        $data3 = [
            ['company_id'=>$company->id, 'name_en'=> 'HRA','name_ar'=> '??????', 'type'=> 'hra', 'percentage'=>25],
            ['company_id'=>$company->id, 'name_en'=> 'Trans','name_ar'=> '??????????????', 'type'=> 'trans', 'percentage'=>10],
            ]; 
            //Allowance::insert($data3);

        $email = [
            'domain' => $request->domain,
            'email' => $request->email,
            'pass' => $pass,
        ];

        Mail::to($request->email)->send(new Password($email));
        return  $user;

    }

}
