<?php

namespace App;

use App\Scopes\CompanyScope;
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

    public function deductions(){
        return $this->hasMany(Deduction::class);
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

}
