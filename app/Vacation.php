<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacation extends Model
{
    use SoftDeletes;
    
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
}
