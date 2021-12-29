<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myrequest extends Model
{

    public function myvacation(){
        return $this->belongsTo(Myvacation::class, "model_id");
    }
}
