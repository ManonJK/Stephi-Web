<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favori extends Model
{
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function bien(){
        return $this->belongsTo('App\Bien');
    }
}
