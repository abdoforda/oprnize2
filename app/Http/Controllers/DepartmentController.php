<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Department::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        $employees = Employee::all();

        $employees = $employees->map(function($name){
            return [
                'value' => $name->id,
                'text' => $name->name,
            ];
        });

        return view('department.index',compact('nationalities','employees'));
    }

    public function update_department_admin(Request $request){

        $de = Employee::findOrFail($request->value);
        if($de){
            $se = Department::findOrFail($request->pk);
            if($se){
                $se->employee_id = $request->value;
                $se->save();
            }
        }
        return "ok";
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
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Department();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->company_id = $company_id;
        $nationality->save();
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $na = Department::findOrFail($request->department);
        if($na->company_id != auth()->user()->company->id){
            return;
        }

        $na->name_ar = $request->name_ar;
        $na->name_en = $request->name_en;
        $na->save();
        return $na;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
