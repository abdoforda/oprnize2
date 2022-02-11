<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('DeSeJo');
    }

    public function index()
    {
        $nationalities = Section::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        $departments = Department::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        $departments2 = $departments->map(function($name){
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

        return view('section.index',compact('nationalities','departments','departments2','employees'));
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
            'department_id'=> ['required'],
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Section();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->department_id = $request->department_id;
        $nationality->company_id = $company_id;
        $nationality->save();
        $nationality->load('department');
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    public function get_sections_from_department_id(Request $request)
    {
        $department = Department::find($request->section);
        return $department->sections;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $na = Section::findOrFail($request->section);
        if($na->company_id != auth()->user()->company->id){
            return;
        }
        $na->name_ar = $request->name_ar;
        $na->name_en = $request->name_en;
        $na->save();
        return $na;
    }

    public function update_department(Request $request)
    {
        $de = Department::findOrFail($request->value);
        if($de){
            $se = Section::findOrFail($request->pk);
            if($se){
                $se->department_id = $request->value;
                $se->save();
            }
        }
        return "ok";
    }

    public function update_section_admin(Request $request){

        $de = Employee::findOrFail($request->value);
        if($de){
            $se = Section::findOrFail($request->pk);
            if($se){
                $se->employee_id = $request->value;
                $se->save();
            }
        }
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
