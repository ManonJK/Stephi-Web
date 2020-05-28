<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $fillable =
        ['superficie', 'nb_pieces', 'etage', 'localisation', 'descriptif', 'prix_min', 'prix_max', 'prix_vente', 'id_user', 'id_type'];

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
        return $this->hasMany('App\Dependance','id_bien');
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
