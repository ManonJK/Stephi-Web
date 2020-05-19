<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependance extends Model
{
    public $timestamps = false;

    public function bien(){
        return $this->belongsToMany('App\Bien','dependances_biens','id_dependance','id_bien');
    }
}
