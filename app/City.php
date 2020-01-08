<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //Relacion entre las ciudades y paises
    public function country(){
        return $this->belongsTo('App\Country');
    }

    //Relacion entre las ciudades y usuarios
    public function users(){
        return $this->hasMany('App\User');
    }
}
