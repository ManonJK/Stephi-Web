<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['id_bien', 'lien'];

    public $timestamps = false;

    public function bien(){
        return $this->belongsTo('App\Bien','id_bien');
    }
}
