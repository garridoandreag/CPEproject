<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckGradeprofessor
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
        $role_id =  $user->role_id;
        
        if($role_id == 1){
            $employeegrades = DB::table('grade')
            ->select('id')
            ->where('status', 'ACTIVO')
            ->get();
        }else {
            $employee_id = $user->person_id;

            $employeegrades = DB::table('grade')
                    ->where('id',$request->grade_id)
                    ->whereRaw('id = any (SELECT coursegrade.grade_id FROM coursegrade 
                                            WHERE coursegrade.employee_id like ?
                                            AND coursegrade.grade_id like grade.id
                                            AND coursegrade.status like "ACTIVO")',$employee_id)
                    ->get();
        }

        
        if(count($employeegrades) == 0 && $user->role_id <> 1){
            return redirect()->route('student.grade');

        };

        return $next($request);
    }
}
