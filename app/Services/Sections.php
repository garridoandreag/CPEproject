<?php

namespace App\Services;


class Sections {
    
    public function get(){
        
    
        $sectionsArray['']='Selecciona una sección';

            $sectionsArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        
        return $sectionsArray;
    }
}