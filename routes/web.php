<?php

use App\Http\Middleware\CheckSettings;
use App\Http\Middleware\SubDomainCheck;
use App\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('delete', function () {
    $user = User::find(2);
    return $user->delete();
    return "1";
});


Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});



Route::domain('{account}.'.env('DOMAIN','oprnize.com'))->group(function ($account) {

    Route::middleware(['auth','CheckSettings'])->group(function () {

        Route::get('/', function ($account) {
            return redirect('/setting');
        });

        Route::get('/delete_tr', 'SettingController@delete_tr');
        Route::get('/setting', 'SettingController@edit');
        Route::post('/setting', 'SettingController@update');
        Route::resource('nationality', 'NationalityController');
        Route::resource('department', 'DepartmentController');
        
        //sections
        Route::resource('section', 'SectionController');
        Route::get('update_department', 'SectionController@update_department');
        
        //jobs
        Route::resource('job', 'JobController');
        Route::get('update_section', 'JobController@update_section');
        
        //vacations
        Route::resource('vacation', 'VacationController');
        Route::get('update_type_vacation', 'VacationController@update_type_vacation');
        
        //allowance
        Route::resource('allowance', 'AllowanceController');
        

        //employee
        Route::resource('/employee', 'EmployeeController');
        Route::get('/search_employee', 'EmployeeController@search_employee');

        //Payroll + deductions
        Route::resource('/deduction', 'DeductionController');
        //Route::resource('/payroll', 'PayrollController');
        Route::get('/payroll', function(){
            return redirect('/');
        });

    }); 

}); // {account}.localhost




Route::post('/register', 'Auth\RegisterController@register')->name('register2');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm');

Route::get('/home', function(){
    return redirect('/');
})->name('home');

Route::get('workspace', 'Auth\LoginController@workspace');
Route::post('/checkdomain', 'Auth\LoginController@checkdomain')->name('checkdomain');


Route::get('/clear', function () {
    Artisan::call('config:cache');
    //Artisan::call('route:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Artisan";
});


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();