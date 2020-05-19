<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    public function biens(){
        return $this->hasMany('App\Bien','id_type');
    }
}
