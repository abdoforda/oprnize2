<?php

namespace App\Http\Controllers;

use App\Approvalstaff;
use App\Employee;
use Illuminate\Http\Request;

class ApprovalstaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvalstaffs = Approvalstaff::all();
        $employees = Employee::all();
        return view('approvalstaff.index',compact(['approvalstaffs','employees']));
    }

    public function approval_staff_update(Request $request){
        $em = Employee::find($request->value[0]);    
        if($em){

            if($request->type == 'insert'){
                $company_id = auth()->user()->company->id;
                $approvalstaff = new Approvalstaff();
                $approvalstaff->company_id = $company_id;
                $approvalstaff->employee_id = $request->value[0];
                $approvalstaff->save();
            }else{
                $approvalstaff = Approvalstaff::where('employee_id',$request->value[0])->first();
                $approvalstaff->delete();
            }
            
            return "Done";
        }
        return "error";
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Approvalstaff  $approvalstaff
     * @return \Illuminate\Http\Response
     */
    public function show(Approvalstaff $approvalstaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Approvalstaff  $approvalstaff
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvalstaff $approvalstaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Approvalstaff  $approvalstaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvalstaff $approvalstaff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Approvalstaff  $approvalstaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvalstaff $approvalstaff)
    {
        //
    }
}
