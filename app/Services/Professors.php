<?php

namespace App\Services;
use App\Employee;

class Professors {
    
    public function get(){
        
        $professors = Employee::get()->where('professor','1')->where('status','ACTIVO');

        $professorsArray['']='Selecciona un professor';

        foreach($professors as $employee){
            $professorsArray[$employee->id] = $employee->person->names.' '.$employee->person->first_surname;
        }
        return $professorsArray;
    }
}