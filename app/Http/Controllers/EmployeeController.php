<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Nationality;
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
        $nationalities = Nationality::where('company_id', auth()->user()->company->id)
        ->orwhere('company_id', NULL)
        ->get();

        return view('employee.create',compact('company','nationalities'));
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
            'job_number' => ['required'],
            'contract_start_date' => ['required'],
            
            // 'gender' => ['required'],
            // 'marital_status' => ['required'],
            // 'nationality_id' => ['required'],
            // 'id_num' => ['required'],
            // 'id_issue_date' => ['required'],
            // 'id_expire_date' => ['required'],
            // 'passport_num' => ['required'],
            // 'passport_issue_date' => ['required'],
            // 'passport_expire_date' => ['required'],
            // 'phone' => ['required'],
            // 'email' => ['required'],
            // 'password' => ['required'],
        ]);
        

        $em = new Employee();
        $em->company_id = auth()->user()->company->id;
        $em->name_ar = $request->name_ar;
        $em->name_en = $request->name_en;
        $em->job_number = $request->job_number;
        $em->salary = $request->salary;
        $em->contract_start_date = $request->contract_start_date;
        $em->save();
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
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
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
