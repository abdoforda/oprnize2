<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    public function edit(){


        $company = auth()->user()->company;

        $nationalities = Nationality::where('company_id', auth()->user()->company->id)
        ->orwhere('company_id', NULL)
        ->get();

        


        return view("setting.edit", compact('nationalities','company'));
    }

    public function update(Request $request){

        $request->validate([
            'name_en' => ['required'],
            'name_ar' => ['required'],
            'extra_work' => ['required'],
            'month_calculator' => ['required'],
            'nationalities' => ['required'],
        ]);

        $com = auth()->user()->company;
        $com->name_en = $request->name_en;
        $com->name_ar = $request->name_ar;
        $com->email = $request->email;
        $com->phone = $request->phone;
        $com->extra_work = $request->extra_work;
        $com->month_calculator = $request->month_calculator;
        $com->save();

        $com->nationalitys()->sync($request->nationalities);

        return "success";
    }
}
