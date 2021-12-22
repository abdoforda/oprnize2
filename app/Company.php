<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function nationalitys()
    {
        return $this->belongsToMany(Nationality::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function vacations(){
        return $this->hasMany(Vacation::class);
    }

    public function allowances(){
        return $this->hasMany(Allowance::class);
    }

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }
    
    public function deductions(){
        return $this->hasMany(Deduction::class);
    }


}
