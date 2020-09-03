<?php

namespace App\Services;
use App\Job;

class Jobs {
    
    public function get(){
        
        $jobs = Job::get();
        $jobsArray['']='Selecciona un puesto de trabajo';
        
        foreach($jobs as $job){
            $jobsArray[$job->id] = $job->job;
        }
        return $jobsArray;
    }
}