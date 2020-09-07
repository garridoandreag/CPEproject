<?php

namespace App\Services;
use App\Course;

class Courses {
    
    public function get(){
        
        $courses = Course::get()->where('status','ACTIVO');
        $coursesArray['']='Selecciona una materia';
        
        foreach($courses as $course){
            $coursesArray[$course->id] = $course->name;
        }
        return $coursesArray;
    }
}