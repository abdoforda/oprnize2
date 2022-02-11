<?php

namespace App;

use App\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class Approvalstaff extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function employee(){
        
        if($this->type == "employee"){
            return $this->belongsTo(Employee::class);
        }

        if($this->type == "section"){
            return $this->belongsTo(Section::class,"employee_id");
        }
        
    }
}
