<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\Deduction;
use App\Department;
use App\Job;
use App\Nationality;
use App\Payroll;
use App\Section;
use App\User;
use App\Vacation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    
    public function edit(){


        $company = auth()->user()->company;

        $nationalities = Nationality::where('company_id', auth()->user()->company->id)
        ->orwhere('company_id', NULL)
        ->get();

        return view("setting.edit", compact('nationalities','company'));
    }

    public function check_email(Request $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            return "error";
        }

        return "asd";
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

        //return count($com->nationalitys);
        if(count($com->nationalitys) == 0){
            $com->nationalitys()->attach($request->nationalities);
        }else{
            $com->nationalitys()->sync($request->nationalities);
        }

        

        return "success";
    }

    public function delete_tr(Request $request){
        

        $request->validate([
            'table'=> Rule::in(['nationalities','departments','sections','jobs','vacations','allowances','deductions','payrolls']),
        ]);

        if($request->table == "departments"){
            $del = Department::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "nationalities"){
            $del = Nationality::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "sections"){
            $del = Section::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "jobs"){
            $del = Job::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "vacations"){
            $del = Vacation::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "allowances"){
            $del = Allowance::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }
        
        if($request->table == "deductions"){
            $del = Deduction::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }

        if($request->table == "payrolls"){
            $del = Payroll::where([['id',$request->id], ['company_id',auth()->user()->company->id]])->first();
        }
        
        $del->delete();
        return "Delete ok";
    }
}
