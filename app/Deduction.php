<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{

    public function getDateAttribute($value) {
        return date('Y-m', strtotime($value));
    }

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope());
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
