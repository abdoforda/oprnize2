<?php

namespace App\Http\Controllers;

use App\Vacation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = Vacation::all();
        return view('vacation.index',compact('nationalities'));
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
            'min'=> ['required','numeric'],
            'max'=> ['required','numeric'],
            'type'=> Rule::in(['all','male','female']),
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Vacation();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->min = $request->min;
        $nationality->max = $request->max;
        $nationality->type = $request->type;
        $nationality->company_id = $company_id;
        $nationality->save();
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(Vacation $vacation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacation $vacation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
            'min'=> ['required','numeric'],
            'max'=> ['required','numeric'],
        ]);

        $na = Vacation::findOrFail($request->vacation);
        if($na->company_id != auth()->user()->company->id){
            return;
        }
        $na->name_ar = $request->name_ar;
        $na->name_en = $request->name_en;
        $na->min = $request->min;
        $na->max = $request->max;
        $na->save();
        return $na;
    }

    public function update_type_vacation(Request $request){

        $request->validate([
            'value'=> Rule::in(['all','male','female']),
        ]);

        $se = Vacation::findOrFail($request->pk);
        if($se){
            $se->type = $request->value;
            $se->save();
        }
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacation $vacation)
    {
        //
    }
}
