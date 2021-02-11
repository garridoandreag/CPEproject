<?php

namespace App\Services;
use App\Cycle;

class Cycles {
    
    public function get(){
        
        $cycles = Cycle::where('status','ACTIVO')->orderBy('id','desc')->get();
        $cyclesArray['']='Selecciona un ciclo escolar';
        
        foreach($cycles as $cycle){
            $cyclesArray[$cycle->id] = $cycle->name;
        }
        return $cyclesArray;
    }

    public function getAll(){
        
        $cycles = Cycle::orderBy('id', 'desc')->get();
        
        foreach($cycles as $cycle){
            $cyclesArray[$cycle->id] = $cycle->name;
        }
        return $cyclesArray;
    }
}