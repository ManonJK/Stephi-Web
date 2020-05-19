<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public $timestamps = false;

    public function agence(){
        return $this->belongsTo('App\Agence', 'id_agence');
    }

    public function users(){
        return $this->hasMany('App\User','id_agent');
    }
}
