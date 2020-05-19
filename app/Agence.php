<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    public $timestamps = false;

    public function agents(){
        return $this->hasMany('App\Agent','id_agence');
    }

}
