<?php

namespace App\Services;
use App\Announcement;
use Carbon\Carbon;

class Announcements {
    
    public function get(){

        $now = Carbon::now();
        
        $announcements = Announcement::get()
                        ->where('status','ACTIVO')
                        ->where('start_time','<=', $now)
                        ->where('end_time','>', $now);
        
        $announcementsArray = null;

        
        foreach($announcements as $announcement){
            $announcementsArray[$announcement->id] = $announcement;
        }
        return $announcementsArray;
    }
}