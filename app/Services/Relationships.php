<?php

namespace App\Services;


class Relationships {
    
    public function get(){
        
    
        $relationshipsArray['']='Selecciona una sección';

            $relationshipsArray = ['Padre','Madre','Abuelo','Abuela','Hermano','Hermana','Tía','Tío','Primo','Prima','Otro'];
        
        return $relationshipsArray;
    }
}