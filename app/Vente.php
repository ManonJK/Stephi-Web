<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    public $timestamps = false;

    public function documents(){
        return $this->hasMany('App\Document');
    }

    public function bien(){
        return $this->belongsTo('App\Bien','id_bien');
    }
}
