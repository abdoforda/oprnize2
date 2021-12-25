<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Department;
use App\Employee;
use App\Nationality;
use App\Section;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
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
            'name_ar' => ['required'],
            'name_en' => ['required'],
            'job_number' => ['required','unique:employees'],
            'contract_start_date' => ['required'],
            'department_id' => ['required'],
            'section_id' => ['required'],
            'job_id' => ['required'],
            'salary' => ['required'],
            'birthdate' => ['required'],

            //'gender' => ['required'],
            //'marital_status' => ['required'],
            'nationality_id' => ['required'],
            'id_num' => ['required','unique:employees','max:10','min:10'],
            //'id_issue_date' => ['required'],
            //'id_expire_date' => ['required'],
            //'passport_num' => ['required'],
            //'passport_issue_date' => ['required'],
            //'passport_expire_date' => ['required'],
            //'phone' => ['required'],
            //'email' => ['required'],
            //'password' => ['required'],

        ]);
        

        $em = new Employee();
        $em->company_id = auth()->user()->company->id;

        $em->birthdate = $request->birthdate;
        $em->gender = $request->gender;
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
            'name_ar' => ['required'],
            'name_en' => ['required'],
            'job_number' => ['required','unique:employees'],
            'contract_start_date' => ['required'],
            'department_id' => ['required'],
            'section_id' => ['required'],
            'job_id' => ['required'],
            'salary' => ['required'],
            'birthdate' => ['required'],

            //'gender' => ['required'],
            //'marital_status' => ['required'],
            'nationality_id' => ['required'],
            'id_num' => ['required','unique:employees','max:10','min:10'],
            //'id_issue_date' => ['required'],
            //'id_expire_date' => ['required'],
            //'passport_num' => ['required'],
            //'passport_issue_date' => ['required'],
            //'passport_expire_date' => ['required'],
            //'phone' => ['required'],
            //'email' => ['required'],
            //'password' => ['required'],

        ]);
        

        $em = Employee::find($request->id_em);

        $em->company_id = auth()->user()->company->id;

        $em->gender = $request->gender;
        $em->birthdate = $request->birthdate;
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
