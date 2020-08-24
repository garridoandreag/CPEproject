<?php

namespace App\Services;
use App\Student;

class Students {
    
    public function get(){
        
        $students = Subdivision::get();
        $studentsArray['']='Selecciona un estudiante';
        
        foreach($students as $student){
            $studentsArray[$student->id] = $student->names.' '.$student->first_surname.' '.$student->second_surname;
        }
        return $studentsArray;
    }
}
