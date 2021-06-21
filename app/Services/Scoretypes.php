<?php

namespace App\Services;

class Scoretypes{

  public function getScoretype(){
        
    
    $scoretypeArray['']='Seleccione la representación de los puntos';

    $scoretypeArray['C'] = 'Con letras';
    $scoretypeArray['N'] = 'Numérica';
    
    return $scoretypeArray;
  }

}