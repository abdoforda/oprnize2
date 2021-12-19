<?php

namespace App\Http\Controllers;

use App\Deduction;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Deduction::all();
        return view('deduction.index',compact('nationalities'));
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
            'type'=> Rule::in(['deduction2','overtime']),
            'job_number'=> ['required'],
            'date'=> ['required'],
            'value'=> ['required'],
        ]);

        $date = Carbon::parse($request->date);

        $employee_id = Employee::search_from_job_number($request->job_number);
        if($employee_id == ''){
            return __('No employee found');
        }
        $employee_id = $employee_id->id;

        $company_id = auth()->user()->company->id;
        $nationality = new Deduction();
        $nationality->desc = $request->desc;
        $nationality->type = $request->type;
        $nationality->date = $date;
        $nationality->value = $request->value;
        $nationality->company_id = $company_id;
        $nationality->employee_id = $employee_id;
        $nationality->save();
        $nationality = $nationality->load('employee');
        $nationality->name_em = $nationality->employee->name;
        $nationality->type = __($nationality->type);
        if($nationality->desc == NULL){
            $nationality->desc = '';
        }
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        //
    }
}
