<?php

namespace App\Services;

class ItsProfessor {
    
    public function get(){
      
        $schoolsArray['1']='Si';
        $schoolsArray['0']='No';
      
        return $schoolsArray;
    }
}