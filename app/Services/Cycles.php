<?php

namespace App\Services;
use App\Cycle;

class Cycles {
    
    public function get(){
        
        $cycles = Cycle::get();
        $cyclesArray['']='Selecciona un ciclo escolar';
        
        foreach($cycles as $cycle){
            $cyclesArray[$cycle->id] = $cycle->name;
        }
        return $cyclesArray;
    }
}