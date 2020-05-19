<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    public $timestamps = false;

    public function vente(){
        return $this->belongsTo('App\Vente');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function dependances(){
        return $this->hasMany('App\Dependance');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function favoris(){
        return $this->hasMany('App\Favori');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
