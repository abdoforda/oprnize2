<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

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

}
