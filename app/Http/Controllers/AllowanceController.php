<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $nationalities = Allowance::all();
        return view('allowance.index',compact('nationalities','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
            'value'=> ['required_without:percentage','numeric','nullable'],
            'percentage'=> ['required_without:value','numeric','nullable'],
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Allowance();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->value = $request->value;
        $nationality->percentage = $request->percentage;
        $nationality->type = "other";
        $nationality->company_id = $company_id;
        $nationality->employee_id = $request->employee_id;
        $nationality->save();

        
        $nationality->type = __($nationality->type);
        $nationality->employee_name = __('All');

        if($nationality->value == NULL){ $nationality->value = ''; }
        if($nationality->percentage == NULL){ $nationality->percentage = ''; }

        if($nationality->employee != NULL){
            $nationality = $nationality->load('employee');
            $nationality->employee_name = $nationality->employee->name;
        }
        
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function show(Allowance $allowance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function edit(Allowance $allowance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
            'value'=> ['required_without:percentage','numeric','nullable'],
            'percentage'=> ['required_without:value','numeric','nullable'],
        ]);

        $nationality = Allowance::findOrFail($request->allowance);
        if($nationality->company_id != auth()->user()->company->id){
            return;
        }

        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->value = $request->value;
        $nationality->percentage = $request->percentage;
        $nationality->employee_id = $request->employee_id;
        $nationality->save();

        $nationality->type = __($nationality->type);
        $nationality->employee_name = __('All');

        if($nationality->value == NULL){ $nationality->value = ''; }
        if($nationality->percentage == NULL){ $nationality->percentage = ''; }

        if($nationality->employee != NULL){
            $nationality = $nationality->load('employee');
            $nationality->employee_name = $nationality->employee->name;
        }
        
        return $nationality;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Allowance  $allowance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allowance $allowance)
    {
        //
    }
}
