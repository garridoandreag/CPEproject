<?php

namespace App\Services;
use App\Announcement;

class Announcements {
    
    public function get(){
        
        $announcements = Announcement::get()->where('status','ACTIVO');
        

        foreach($announcements as $announcement){
            $announcementsArray[$announcement->id] = $announcement;
        }
        return $announcementsArray;
    }
}