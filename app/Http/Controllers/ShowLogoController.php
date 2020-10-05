<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use App\School;

class ShowLogoController extends Controller
{
    public function getImage(Request $filename)
    {
        $exists = Storage::disk('school')->exists($filename);
        if($exists){
            $file = Storage::disk('school')->get($filename);
        }else{
            $filename = 'logo.jpg';
            $file = Storage::disk('school')->get($filename);
        }

        
        
        return new Response($file,200);
    }
}
