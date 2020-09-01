<?php

namespace App\Services;
use App\SChool;

class Schools {
    
    public function get(){
        
        $schools = School::get();
        $schoolsArray['']='Selecciona una instancia del colegio';
        
        foreach($schools as $school){
            $schoolsArray[$school->id] = $school->name;
        }
        return $schoolsArray;
    }
}