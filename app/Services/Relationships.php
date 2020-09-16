<?php

namespace App\Services;


class Relationships {
    
    public function get(){
        
    
        $relationshipsArray['']='Selecciona una sección';

            $relationshipsArray = ['Padre/Madre','Abuelo(a)','Hermano(a)','Tío(a)','Primo(a)','Amigo(a)','Vecino(a)','Otro'];
        
        return $relationshipsArray;
    }
}