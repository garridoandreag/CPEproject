<?php

namespace App\Services;
use App\Unit;

class Units {
    
    public function get(){
        
        $units = Unit::get();
        
        foreach($units as $unit){
            $unitsArray[$unit->id] = $unit->name;
        }
        return $unitsArray;
    }
}
