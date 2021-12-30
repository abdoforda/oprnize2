<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Myvacation extends Model
{
    public function vacation(){
        return $this->belongsTo(Vacation::class);
    }

    public function the_number_of_days(){
        
        $date = Carbon::parse($this->start);
        $now  = Carbon::parse($this->end);
        return $date->diffInDays($now)+1;
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
