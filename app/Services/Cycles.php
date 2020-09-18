<?php

namespace App\Services;
use App\Cycle;

class Cycles {
    
    public function get(){
        
        $cycles = Cycle::get()->where('status','ACTIVO');
        $cyclesArray['']='Selecciona un ciclo escolar';
        
        foreach($cycles as $cycle){
            $cyclesArray[$cycle->id] = $cycle->name;
        }
        return $cyclesArray;
    }

    public function getAll(){
        
        $cycles = Cycle::get();
        
        foreach($cycles as $cycle){
            $cyclesArray[$cycle->id] = $cycle->name;
        }
        return $cyclesArray;
    }
}