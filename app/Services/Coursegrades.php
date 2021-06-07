<?php

namespace App\Services;
use App\Coursegrade;

class Coursegrades {
    
    public function get(){
        
        $coursegrades = Coursegrade::get()->where('status','ACTIVO');
        $coursesArray['']='Selecciona una materia';
        
        foreach($coursegrades as $coursegrade){
            $coursegradesArray[$coursegrade->id] = $coursegrade->course->name;
        }
        return $coursegradesArray;
    }

        
    public function getOnlyCourses(){
        
      $coursegrades = Coursegrade::get()->where('status','ACTIVO');
      $coursesArray['']='Selecciona una materia';
      
      foreach($coursegrades as $coursegrade){
          $coursegradesArray[$coursegrade->id] = $coursegrade->course->name;
      }
      return $coursegradesArray;
    }
}