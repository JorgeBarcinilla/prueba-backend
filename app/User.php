<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'city_id', 'country_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion entre los usuarios y paises
    public function country(){
        return $this->belongsTo('App\Country');
    }

    //Relacion entre los usuarios y ciudades
    public function city(){
        return $this->belongsTo('App\City');
    }


    //Metodos añadidos a eloquent para el filtrado de datos

    public function scopeIdentification($query, $identification){
        if($identification)
            return $query->where('identification', 'LIKE', "%$identification%");
    }
    public function scopeName($query, $name){
        if($name)
            return $query->where('name', 'LIKE', "%$name%");
    }
    public function scopeDateBirth($query, $date_birth){
        if($date_birth)
            return $query->where('date_birth', 'LIKE', "%$date_birth%");
    }
    public function scopeCountry($query, $country_id){
        if($country_id)
            return $query->where('country_id', $country_id);
    }
    public function scopeCity($query, $city_id){
        if($city_id)
            return $query->where('city_id',$city_id);
    }
    
}
