<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    //
     protected $table = 'encargado';
    
        public function estudiantes(){
         return $this->belongsToMany('App\Estudiante','encargado_estudiante','estudiante_id','encargado_id');
    }
    
//        // Relacion One To Many
    public function usuario() {

        return $this->hasOne('App\User','id');
    }
//    
}
