<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }
    
    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }
    
}
