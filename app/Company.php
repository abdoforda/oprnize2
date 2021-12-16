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

    public function vacations(){
        return $this->hasMany(Vacation::class);
    }

    public function allowances(){
        return $this->hasMany(Allowance::class);
    }


}
