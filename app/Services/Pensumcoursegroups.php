<?php

namespace App\Services;
use App\{Pensumcoursegroup, Grade};

class Pensumcoursegroups{

  public function get(){

    $pensumcoursegroups = Pensumcoursegroup::get();

    $groupArray[''] = 'Seleccione un grupo';

    foreach($pensumcoursegroups as $pensumcoursegroup){
      $groupArray[$pensumcoursegroup->id] = $pensumcoursegroup->name;

    }

    return $groupArray;
  }

}