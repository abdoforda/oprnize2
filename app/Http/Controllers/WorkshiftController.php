<?php

namespace App\Http\Controllers;

use App\Workshift;
use Illuminate\Http\Request;

class WorkshiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Workshift::all();
        return view('workshift.index',compact('nationalities'));
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
            'start'=> ['required','date_format:H:i'],
            'end'=> ['required','date_format:H:i']
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Workshift();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->start = $request->start;
        $nationality->end = $request->end;
        $nationality->company_id = $company_id;
        $nationality->save();
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function show(Workshift $workshift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshift $workshift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
            'start'=> ['required','date_format:H:i'],
            'end'=> ['required','date_format:H:i']
        ]);

        $nationality = Workshift::findOrFail($request->workshift);
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->start = $request->start;
        $nationality->end = $request->end;
        $nationality->save();
        return $nationality;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshift  $workshift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshift $workshift)
    {
        //
    }
}
