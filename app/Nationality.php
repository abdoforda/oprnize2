<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    public function getNameAttribute($value) {
        return $this->{'name_'.app()->getLocale()};
    }

    


}
