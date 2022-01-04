<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;

    public function getDateAttribute($value) {
        return date('Y-m', strtotime($value));
    }
    
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function ems(){

        $lastDayofMonth = Carbon::parse($this->date)->endOfMonth()->toDateString();
        $firstDayofMonth = Carbon::parse($this->date)->firstOfMonth()->toDateString();
        
        $ems = Employee::where('contract_start_date','<=',$lastDayofMonth)->get();
        $ems2 = $ems->map(function($em) use ($lastDayofMonth,$firstDayofMonth){ 
            

            $overtime_values = $em->overtimes()->whereBetween('date', [$firstDayofMonth, $lastDayofMonth])->sum('value');
            $Hourly_salary_in_total = $em->Hourly_salary_in_total($em, $firstDayofMonth, $lastDayofMonth);
            $Hourly_salary_in_basic = $em->Hourly_salary_in_basic($em, $firstDayofMonth, $lastDayofMonth);
            
            $today_price = $Hourly_salary_in_basic*8;

            $paymentDate=date('Y-m-d', strtotime($em->contract_start_date));
            $contractDateBegin = date('Y-m-d', strtotime($firstDayofMonth));
            $contractDateEnd = date('Y-m-d', strtotime($lastDayofMonth));
                
            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
                
                $date = Carbon::parse($paymentDate);
                $now  = Carbon::parse($lastDayofMonth);
                $working_days = ($date->diffInDays($now)+1);

                $em->working_days = $working_days;
                $em->salary = $today_price * $working_days; // basic

                

            }

            if($em->company->extra_work == "basic"){
                $em->payroll_overtime = $Hourly_salary_in_basic*$overtime_values*1.5;
            }

            if($em->company->extra_work == "total"){
                $em->payroll_overtime = $Hourly_salary_in_total*$overtime_values*1.5;
            }

            if($em->company->extra_work == "saudi"){
                $em->payroll_overtime = $Hourly_salary_in_basic*$overtime_values*0.5;
                $em->payroll_overtime += $Hourly_salary_in_total*$overtime_values;
            }


            return $em;
        });

        return $ems2;

    }

    


}
