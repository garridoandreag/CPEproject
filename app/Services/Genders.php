<?php

namespace App\Services;
use App\Gender;

class Genders {
    
    public function get(){
        
        $genders = Gender::get();
        $gendersArray['']='Selecciona el género';
        
        foreach($genders as $gender){
            $gendersArray[$gender->id] = $gender->name;
        }
        return $gendersArray;
    }
}