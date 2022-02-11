<?php

namespace App\Http\Controllers;

use App\Approvalstaff;
use App\Department;
use App\Employee;
use App\Section;
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
        
        $department = Department::where('employee_id','!=',NULL)->get();
        $section = Section::where('employee_id','!=',NULL)->get();
        $section = $section->map(function($name){
            return [
                'value' => $name->id,
                'text' => $name->name,
            ];
        });

        $employees = Employee::all();
        $employees = $employees->map(function($name){
            return [
                'value' => $name->id,
                'text' => $name->name,
            ];
        });

        return view('approvalstaff.index',compact(['approvalstaffs','employees','department','section']));
    }

    public function update_approvalstaffs_employee(Request $request){

        $type2 = "employee";
        $em = Employee::find($request->value[0]);
        if($em){

            if($request->pk != "new"){
                $approvalstaff = Approvalstaff::find($request->pk);
                $approvalstaff->type = $type2;
                $approvalstaff->employee_id = $request->value[0];
                $approvalstaff->manager = "";
                $approvalstaff->save();
                
            }

            if($request->pk == "new"){
                $company_id = auth()->user()->company->id;
                $approvalstaff = new Approvalstaff();
                $approvalstaff->company_id = $company_id;
                $approvalstaff->type = $type2;
                $approvalstaff->employee_id = $request->value[0];
                $approvalstaff->manager = "";
                $approvalstaff->save(); 
            }

            return "Done";

        }
        return "error";
    }

    public function update_approvalstaffs_manger(Request $request){


        if($request->pk != "new"){

            $approvalstaff = Approvalstaff::find($request->pk);
            if($request->value == "true"){
                $approvalstaff->manager = "true";
                $approvalstaff->save();
            }else{
                if($approvalstaff->type == ''){
                    $approvalstaff->delete();
                }else{
                    $approvalstaff->manager = "false";
                    $approvalstaff->save();
                }
            }

        }

        if($request->pk == "new"){
            $company_id = auth()->user()->company->id;
            $approvalstaff = new Approvalstaff();
            $approvalstaff->company_id = $company_id;
            $approvalstaff->manager = "true";
            $approvalstaff->save(); 
            return $approvalstaff;
        }


        return "Done";
    }

    public function delete_approvalstaff(Request $request){
        $Approvalstaff = Approvalstaff::find($request->pk);

        if($Approvalstaff->company_id == auth()->user()->company->id){
            $Approvalstaff->delete();
        }
        return "ok";
    }

    public function update_approvalstaffs_section(Request $request){

        $type2 = "section";
        $em = Employee::find($request->value[0]);
        if($em){

            if($request->pk != "new"){
                $approvalstaff = Approvalstaff::find($request->pk);
                $approvalstaff->type = $type2;
                $approvalstaff->employee_id = $request->value[0];
                $approvalstaff->manager = "";
                $approvalstaff->save();
                
            }

            if($request->pk == "new"){
                $company_id = auth()->user()->company->id;
                $approvalstaff = new Approvalstaff();
                $approvalstaff->company_id = $company_id;
                $approvalstaff->type = $type2;
                $approvalstaff->employee_id = $request->value[0];
                $approvalstaff->manager = "";
                $approvalstaff->save(); 
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
