<?php

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

        Route::get('/', 'DashboardController@index');

        //user
        Route::get('edit_password', 'UserController@edit_password');
        Route::post('edit_password', 'UserController@edit_password_post');
        

        Route::get('/logout', 'SettingController@logout');
        Route::get('/permission/{employee}', 'SettingController@permission');
        Route::post('/update_permasstion', 'SettingController@update_permasstion');

        Route::get('/delete_tr', 'SettingController@delete_tr');
        Route::get('/setting', 'SettingController@edit');
        Route::post('/setting', 'SettingController@update');
        Route::resource('nationality', 'NationalityController');

        //department
        Route::resource('department', 'DepartmentController');
        Route::get('get_sections_from_department_id', 'SectionController@get_sections_from_department_id');
        Route::get('get_jobs_from_section_id', 'JobController@get_jobs_from_section_id');
        Route::get('update_department_admin', 'DepartmentController@update_department_admin');

        //sections
        Route::resource('section', 'SectionController');
        Route::get('update_department', 'SectionController@update_department');
        Route::get('update_section_admin', 'SectionController@update_section_admin');
        
        
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
        Route::post('/employee_update', 'EmployeeController@update2');
        Route::get('/search_employee', 'EmployeeController@search_employee');
        Route::get('/export_employee', 'EmployeeController@export');

        //Payroll + deductions
        Route::resource('/deduction', 'DeductionController');
        Route::resource('/payroll', 'PayrollController');

        //request
        Route::resource('/request', 'MyrequestController');
        Route::get('/request_employees', 'MyrequestController@requestemployees');
        Route::get('/update_request', 'MyrequestController@update_request');
        Route::resource('/approvalstaff', 'ApprovalstaffController');
        Route::get('/approval_staff_update', 'ApprovalstaffController@approval_staff_update');
        Route::get('/update_approvalstaffs_employee', 'ApprovalstaffController@update_approvalstaffs_employee');
        Route::get('/update_approvalstaffs_section', 'ApprovalstaffController@update_approvalstaffs_section');
        Route::get('/update_approvalstaffs_manger', 'ApprovalstaffController@update_approvalstaffs_manger');
        Route::get('/delete_approvalstaff', 'ApprovalstaffController@delete_approvalstaff');
        Route::get('/view', 'MyrequestController@view');

        //work shift
        Route::resource('/workshift', 'WorkshiftController');
        Route::resource('/attendances', 'AttendanceController');
        Route::get('/update_attendances', 'AttendanceController@update_attendances');

        

    }); 

}); // {account}.localhost



Route::get('/check_email', 'SettingController@check_email');
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