<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Model
{
    use SoftDeletes;
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }

    public function companys(){
        return $this->belongsToMany(Company::class);
    }

}
