<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    public $timestamps = false;

    public function vente()
    {
        return $this->hasOne('App\Vente', 'id_bien');
    }

    public function images()
    {
        return $this->hasMany('App\Image','id_bien');
    }

    public function dependances()
    {
        return $this->belongsToMany('App\Dependance','dependances_biens','id_bien','id_dependance');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'id_type');
    }

    public function favoris()
    {
        return $this->hasMany('App\Favori','id_bien');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
