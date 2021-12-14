<?php

namespace App\Http\Controllers;

use App\Job;
use App\Section;
use Illuminate\Http\Request;

class JobController extends Controller
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
        
        $nationalities = Job::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        $sections = Section::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        $sections2 = $sections->map(function($name){
            return [
                'value' => $name->id,
                'text' => $name->name,
            ];
        });

        return view('job.index',compact('nationalities','sections','sections2'));
    
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
            'section_id'=> ['required'],
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Job();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->section_id = $request->section_id;
        $nationality->company_id = $company_id;
        $nationality->save();
        $nationality->load('section');
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $na = Job::findOrFail($request->job);
        if($na->company_id != auth()->user()->company->id){
            return;
        }
        $na->name_ar = $request->name_ar;
        $na->name_en = $request->name_en;
        $na->save();
        return $na;
    }

    public function update_section(Request $request)
    {
        $de = Section::findOrFail($request->value);
        if($de){
            $se = Job::findOrFail($request->pk);
            if($se){
                $se->section_id = $request->value;
                $se->save();
            }
        }
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
