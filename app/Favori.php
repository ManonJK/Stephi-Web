<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favori extends Model
{
    public $timestamps = false;

    protected $fillable =
        ['id_bien', 'id_user'];

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }

    public function bien(){
        return $this->belongsTo('App\Bien','id_bien');
    }
}
