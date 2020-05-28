<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependance extends Model
{
    public $timestamps = false;

    public function bien(){
        return $this->belongsTo('App\Bien', 'id_bien');
    }
}
