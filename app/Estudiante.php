<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    protected $table = 'estudiante';
    
    // Relacion Many To Many
    
    public function encargados(){
        return $this->belongsToMany('App\Encargado','encargado_estudiante','estudiante_id','encargado_id');
    }
    
//    // Relacion One To Many
//    public function estudiante_encargado() {
//
//        return $this->hasMany('App\Estudiante_Encargado');
//    }
    
    
}
