<?php

namespace App\Services;


class Sections {
    
    public function get(){
        
    
        $statusArray['']='Selecciona un estado';

            $statusArray = ['ACTIVO','INACTIVO'];
        
        return $statusArray;
    }
}