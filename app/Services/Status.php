<?php

namespace App\Services;


class Status {
    
    public function get(){
        
    
        $statusArray['']='Selecciona un estado';

            $statusArray = ['ACTIVO','INACTIVO'];
        
        return $statusArray;
    }
}