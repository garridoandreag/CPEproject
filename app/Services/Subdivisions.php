<?php

namespace App\Services;
use App\Subdivision;

class Subdivisions {
    
    public function get(){
        
        $subdivisions = Subdivision::get();
        $subdivisionsArray['']='Selecciona un departamento';
        
        foreach($subdivisions as $subdivision){
            $subdivisionsArray[$subdivision->code] = $subdivision->name;
        }
        return $subdivisionsArray;
    }
}
