<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = false;

    public function vente(){
        return $this->belongsTo('App\Vente');
    }
}
