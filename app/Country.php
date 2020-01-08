<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //Relacion entre los paises y ciudades
    public function cities(){
        return $this->hasMany('App\City');
    }

    //Relacion entre los paises y usuarios
    public function users(){
        return $this->hasMany('App\User');
    }
}
