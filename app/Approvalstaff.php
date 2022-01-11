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
}
