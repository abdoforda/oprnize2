<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public static function search_from_job_number($job_number){
        $em = Employee::query()
        ->where('job_number', 'LIKE', "%{$job_number}%")
        ->orWhere('name_ar', 'LIKE', "%{$job_number}%")
        ->orWhere('name_en', 'LIKE', "%{$job_number}%")->first();
        if($em){
            $em->name = $em->name;
        }
        return $em;
    }

    public static function daily_salary(Employee $em, $date_start,$date_end){
        if($em->company->month_calculator == "30days"){
            return ($em->salary / 30);
        }

        $days = Carbon::parse($date_end)->daysInMonth;
        return ($em->salary / $days);
    }

    public function deductions(){
        return $this->hasMany(Deduction::class);
    }

    public function overtimes(){
        return $this->deductions()->where('type','overtime');
    }

    public function payroll($date){
        return $date;
    }


    public function payroll_hra(){

        if($this->nationality_id == 1){
            $salary = $this->salary;
        }
        return 0.00;
    }

    public function payroll_gosi(){

        if($this->nationality_id == 1){
            $salary = $this->salary;
        }
        return 0.00;
    }


}
