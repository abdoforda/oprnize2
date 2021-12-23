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
