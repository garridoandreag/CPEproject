<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Student;

class Students {

    public function get(){

        $students = Student::get();


        $studentsArray['']='Seleccione a un estudiante';
        foreach($students as $student){
            $studentsArray[$student->id] = $student->person->names.' '.$student->person->first_surname.' '.$student->person->second_surname;
        }
        return $studentsArray;
    }


    public function getMyStudents(){

        $user = \Auth::user();
        
        $id = $user->person_id;

        $studenttutors = DB::table('studenttutor')
                            ->join('person','studenttutor.student_id','person.id')
                            ->where('studenttutor.tutor_id',$id)
                            ->select('studenttutor.student_id as id','person.names as names','person.first_surname as first_surname','person.second_surname as second_surname')
                            ->get();

        foreach($studenttutors as $student){

            $studenttutorsArray[$student->id] = $student->names.' '.$student->first_surname.' '.$student->second_surname;
        }
        return $studenttutorsArray;
    }

}
