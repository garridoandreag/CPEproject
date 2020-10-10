<?php

namespace App\Services;
use App\Student;

class Students {

    public function get(){

        $students = Student::get();


        foreach($students as $student){
            $studentsArray[$student->id] = $student->person->names.' '.$student->person->first_surname.' '.$student->person->second_surname;
        }
        return $studentsArray;
    }
}
