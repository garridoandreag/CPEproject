<?php

namespace App\Services;
use App\Subjectstudent;

class Subjectstudents {
    
    public function get($id){
        
        $subjectstudents = Subjectstudent::get()->where('coursegrade_id',$id);
        
        foreach($subjectstudents as $subjectstudent){
            $subjectstudentsArray[$subjectstudent->id] = $subjectstudent;
        }
        return $subjectstudentsArray;
    }
}