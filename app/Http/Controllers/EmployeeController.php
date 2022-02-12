<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Department;
use App\Employee;
use App\Nationality;
use App\Rules\UniqueJobNumber;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('DeSeJo');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = auth()->user()->company;
        $nationalities = $company->nationalitys;
        return view('employee.create',compact('company','nationalities'));
    }

    public function search_employee(Request $request)
    {

        $em = Employee::search_from_job_number($request->job_number);
        return $em;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => ['required','unique:employees'],
            'name_en' => ['required','unique:employees'],
            
            'contract_start_date' => ['required'],
            'department_id' => ['required'],
            'section_id' => ['required'],
            'job_id' => ['required'],
            'salary' => ['required'],
            'birthdate' => ['required'],

            'gender' => ['required'],
            'marital_status' => ['required'],
            'workshift_id' => ['required'],
            'nationality_id' => ['required'],
            'contract_end_date' => ['required'],
            'annual_balance' => ['required'],
            'id_num' => ['required','unique:employees','max:10','min:10'],
            'job_number' => ['required', new UniqueJobNumber()],
            'phone' => ['required','unique:employees'],
            'email' => ['required','unique:employees'],

            //'passport_num' => ['required'],
            //'passport_issue_date' => ['required'],
            //'passport_expire_date' => ['required'],
            //'contract_type' => ['required'],
            //'employment_type' => ['required'],
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required'],
            'id_issue_date' => ['required_without:id_issue_date_hijri'],
            'id_expire_date' => ['required_without:id_expire_date_hijri'],
            'id_issue_date_hijri' => ['required_without:id_issue_date'],
            'id_expire_date_hijri' => ['required_without:id_expire_date'],

        ]);
        

        $em = new Employee();
        $em->company_id = auth()->user()->company->id;

        $em->birthdate = $request->birthdate;
        $em->available_balance = $request->available_balance;
        $em->contract_end_date = $request->contract_end_date;
        $em->contract_type = $request->contract_type;
        $em->employment_type = $request->employment_type;
        $em->gender = $request->gender;
        $em->annual_balance = $request->annual_balance;
        $em->marital_status = $request->marital_status;
        $em->nationality_id = $request->nationality_id;
        $em->id_num = $request->id_num;
        $em->workshift_id = $request->workshift_id;
        $em->id_issue_date = $request->id_issue_date;
        $em->id_expire_date = $request->id_expire_date;
        $em->passport_num = $request->passport_num;
        $em->passport_issue_date = $request->passport_issue_date;
        $em->passport_expire_date = $request->passport_expire_date;
        $em->phone = $request->phone;
        $em->email = $request->email;
        $em->password = $request->password;
        $em->name_ar = $request->name_ar;
        $em->name_en = $request->name_en;
        $em->job_number = $request->job_number;
        $em->salary = $request->salary;
        $em->department_id = $request->department_id;
        $em->section_id = $request->section_id;
        $em->job_id = $request->job_id;
        $em->hra_value = $request->hra_value;
        $em->hra_percentage = $request->hra_percentage;
        $em->trans_value = $request->trans_value;
        $em->trans_percentage = $request->trans_percentage;
        $em->contract_start_date = $request->contract_start_date;
        $em->id_issue_date_hijri = $request->id_issue_date_hijri;
        $em->id_expire_date_hijri = $request->id_expire_date_hijri;
        $em->save();



        if($request->allowance_name_ar){
            foreach($request->allowance_name_ar as $index => $a){

                $check = true;
    
                if($request->allowance_name_ar[$index] == ''){ $check = false; }
                if($request->allowance_name_en[$index] == ''){ $check = false; }
                if($request->allowance_value[$index] == '' && $request->allowance_percentage[$index] == ''){ $check = false; }
    
    
                if($check){
    
                    $company_id = auth()->user()->company->id;
                    $nationality = new Allowance();
                    $nationality->name_ar = $request->allowance_name_ar[$index];
                    $nationality->name_en = $request->allowance_name_en[$index];
                    $nationality->value = $request->allowance_value[$index];
                    $nationality->percentage = $request->allowance_percentage[$index];
                    $nationality->type = "other";
                    $nationality->company_id = $company_id;
                    $nationality->employee_id = $em->id;
                    $nationality->save();
                }
                
    
            }
        }

        $user = new User();
        $user->name = "User";
        $user->domain = auth()->user()->company->domain;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = "employee";
        $user->employee_id = $em->id;
        $user->company_id = auth()->user()->company->id;
        $user->save();

        return $em;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $em = Employee::findOrFail($request->employee);
        return $em;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $company = auth()->user()->company;
        $nationalities = $company->nationalitys;
        
        $em = Employee::findOrFail($request->employee);
        
        $department = Department::find($em->department_id);
        $sections = $department->sections;

        $Section2 = Section::find($em->section_id);
        $jobs = $Section2->jobs;
        
        return view('employee.create',compact('em','nationalities','company','sections','jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request)
    {

        $request->validate([
            'id_em' => ['required'],
            'name_ar' => ['required', Rule::unique('employees')->ignore($request->id_em)],
            'name_en' => ['required', Rule::unique('employees')->ignore($request->id_em)],
            'contract_start_date' => ['required'],
            'department_id' => ['required'],
            'section_id' => ['required'],
            'job_id' => ['required'],
            'salary' => ['required'],
            'birthdate' => ['required'],
            'workshift_id' => ['required'],
            'gender' => ['required'],
            'marital_status' => ['required'],
            'nationality_id' => ['required'],
            'contract_end_date' => ['required'],
            'annual_balance' => ['required'],
            'id_num' => ['required',Rule::unique('employees')->ignore($request->id_em),'max:10','min:10'],
            'job_number' => ['required',Rule::unique('employees')->ignore($request->id_em)],
            'phone' => ['required',Rule::unique('employees')->ignore($request->id_em)],
            'email' => ['required',Rule::unique('employees')->ignore($request->id_em)],
            
            //'passport_num' => ['required'],
            //'passport_issue_date' => ['required'],
            //'passport_expire_date' => ['required'],
            //'contract_type' => ['required'],
            //'employment_type' => ['required'],
            'id_issue_date' => ['required_without:id_issue_date_hijri'],
            'id_expire_date' => ['required_without:id_expire_date_hijri'],
            'id_issue_date_hijri' => ['required_without:id_issue_date'],
            'id_expire_date_hijri' => ['required_without:id_expire_date'],

        ]);
        

        $em = Employee::find($request->id_em);

        $em->company_id = auth()->user()->company->id;

        $em->birthdate = $request->birthdate;
        $em->contract_end_date = $request->contract_end_date;
        $em->contract_type = $request->contract_type;
        $em->employment_type = $request->employment_type;
        $em->gender = $request->gender;
        $em->annual_balance = $request->annual_balance;
        $em->workshift_id = $request->workshift_id;
        $em->marital_status = $request->marital_status;
        $em->nationality_id = $request->nationality_id;
        $em->id_num = $request->id_num;
        $em->id_issue_date = $request->id_issue_date;
        $em->id_expire_date = $request->id_expire_date;
        $em->passport_num = $request->passport_num;
        $em->passport_issue_date = $request->passport_issue_date;
        $em->passport_expire_date = $request->passport_expire_date;
        $em->phone = $request->phone;
        $em->email = $request->email;
        $em->password = $request->password;
        $em->name_ar = $request->name_ar;
        $em->name_en = $request->name_en;
        $em->job_number = $request->job_number;
        $em->salary = $request->salary;
        $em->department_id = $request->department_id;
        $em->section_id = $request->section_id;
        $em->job_id = $request->job_id;
        $em->hra_value = $request->hra_value;
        $em->hra_percentage = $request->hra_percentage;
        $em->trans_value = $request->trans_value;
        $em->trans_percentage = $request->trans_percentage;
        $em->contract_start_date = $request->contract_start_date;
        $em->id_issue_date_hijri = $request->id_issue_date_hijri;
        $em->id_expire_date_hijri = $request->id_expire_date_hijri;
        $em->save();

        foreach($em->allowances as $is){
            $is->delete();
        }

        if($request->allowance_name_ar){
            foreach($request->allowance_name_ar as $index => $a){

                $check = true;
    
                if($request->allowance_name_ar[$index] == ''){ $check = false; }
                if($request->allowance_name_en[$index] == ''){ $check = false; }
                if($request->allowance_value[$index] == '' && $request->allowance_percentage[$index] == ''){ $check = false; }
    
    
                if($check){
    
                    $company_id = auth()->user()->company->id;
                    $nationality = new Allowance();
                    $nationality->name_ar = $request->allowance_name_ar[$index];
                    $nationality->name_en = $request->allowance_name_en[$index];
                    $nationality->value = $request->allowance_value[$index];
                    $nationality->percentage = $request->allowance_percentage[$index];
                    $nationality->type = "other";
                    $nationality->company_id = $company_id;
                    $nationality->employee_id = $em->id;
                    $nationality->save();
                }
                
    
            }
        }
        

        return $em;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
