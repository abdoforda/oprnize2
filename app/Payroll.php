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

    public function ems(){

        $lastDayofMonth = Carbon::parse($this->date)->endOfMonth()->toDateString();
        $firstDayofMonth = Carbon::parse($this->date)->firstOfMonth()->toDateString();
        
        $ems = Employee::where('contract_start_date','<=',$lastDayofMonth)->get();
        $ems2 = $ems->map(function($em) use ($lastDayofMonth,$firstDayofMonth){ 
            
            $em->payroll_allowances = (($em->overtimes()->whereBetween('date', [$firstDayofMonth, $lastDayofMonth])->sum('value')) * $em->daily_salary($em, $firstDayofMonth, $lastDayofMonth));

            return $em;
        });

        return $ems2;

    }

    


}
