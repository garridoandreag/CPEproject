<?php

namespace App\Services;
use App\Consonantscore;

class Consonantscores{

  public function get(){

    $consonantscores = Consonantscore::get();

    $consonantscoresArray[''] = '';

    foreach($consonantscores as $consonantscore){
        $consonantscoresArray[$consonantscore->id] = $consonantscore->name;
    }
    return $consonantscoresArray;
  }



}