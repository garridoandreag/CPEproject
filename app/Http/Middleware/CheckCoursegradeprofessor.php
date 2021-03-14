<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Coursegrade; 
use Closure;

class CheckCoursegradeprofessor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = \Auth::user();
        
        $id = $user->person_id;

        $coursegrade=Coursegrade::select('coursegrade.id','coursegrade.grade_id','coursegrade.course_id','coursegrade.cycle_id','coursegrade.employee_id','coursegrade.status')
        ->where('coursegrade.employee_id', $id )
        ->where('coursegrade.status','ACTIVO')
        ->where('coursegrade.id',$request->coursegrade_id)
        ->join('cycle','cycle.id','coursegrade.cycle_id')
        ->where('cycle.status','ACTIVO')->get();

        /*
        $coursegrade = Coursegrade::whereExists(function ($query) use ($id,$request) {
            $query->select(DB::raw(1))
            ->from('coursegrade')
            ->where('coursegrade.employee_id', $id )
            ->where('coursegrade.status','ACTIVO')
            ->where('coursegrade.id',$request->coursegrade_id)
            ->join('cycle','cycle.id','coursegrade.cycle_id')
            ->where('cycle.status','ACTIVO');

        })->get();*/

        //var_dump($coursegrade);
        //die();

        if(count($coursegrade) == 0 && $user->role_id <> 1){
            return redirect()->route('courseprofessor.index');

        };
        return $next($request);

    }
}
