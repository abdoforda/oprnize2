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

}
