<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;
    
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }
    
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }
    
}
