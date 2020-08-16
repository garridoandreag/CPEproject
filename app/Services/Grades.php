<?php

namespace App\Services;
use App\Grade;

class Grades {
    
    public function get(){
        
        $grades = Grade::get();
        $gradesArray['']='Selecciona un grado';
        foreach($grades as $grade){
            $gradesArray[$grade->id] = $grade->name;
        }
        return $gradesArray;
    }
}
