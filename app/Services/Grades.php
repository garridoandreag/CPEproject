<?php

namespace App\Services;
use App\Grade;

class Grades {
    
    public function get(){
        
        $grades = Grade::get()->where('status','ACTIVO');
        $gradesArray['']='';
        foreach($grades as $grade){
            $gradesArray[$grade->id] = $grade->name;
        }
        return $gradesArray;
    }

    public function getAllActive(){
        
        $grades = Grade::get()->where('status','ACTIVO');
        
        foreach($grades as $grade){
            $gradesArray[$grade->id] = $grade->name;
        }
        return $gradesArray;
    }

}
