<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encargado_Estudiante extends Model {

    //

    protected $table = 'encargado_estudiante';

    public function estudiantes() {
        return $this->hasMany('App\Estudiante');
    }

    public function encargados() {
        return $this->hasMany('App\Encargado');
    }
    
    

}
