<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Pensum,Grade};


class PensumController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function menu(){

        $grades = \App\Grade::sortable()->paginate(30);

        return view('pensum.menu', compact('grades'));
    }

    public function detail($grade_id)
    {
        $pensums=Pensum::where('grade_id',$grade_id)->where('status','ACTIVO')->orderBy('courseorder')
        ->sortable()->paginate(20);

        return view('pensum.detail', compact('pensums','grade_id'));
    }

    
    public function edit($grade_id){
        $pensums=Pensum::where('grade_id',$grade_id)
        ->sortable()->paginate(30);

        $grade=Grade::where('id',$grade_id);

        return view('pensum.create', compact('pensums','grade_id','grade'));
    }

    public function update(Request $request){

        $pensums = sizeof($request->input('course_id'));
        $id = $request->input('grade_id');
        $course_id = $request->input('course_id');
        $course_id2size = sizeof($request->input('course_id2'));
        $course_id2 = $request->input('course_id2');

        $courseorder = $request->input('courseorder');

        $datos = Pensum::where('grade_id', $id)
        ->update([
            'status' => 'INACTIVO' ,
            ]);

        for($i = 0; $i < $pensums; $i++){

                $datos = Pensum::where('grade_id', $id)
                ->where('course_id',$course_id[$i])
                ->update([
                    'status' => 'ACTIVO' ,
                    ]);

        }


        for($j = 0; $j < $course_id2size; $j++){

            $datos = Pensum::where('grade_id', $id)
            ->where('course_id',$course_id2[$j])
            ->update([
                'courseorder' => $courseorder[$j],
                ]);

    }

        $grade_id = $request->input('grade_id');

        return redirect()->action('PensumController@detail', ['grade_id' => $grade_id])
                        ->with(['status' => 'Curso y grado actualizado correctamente.']);

    }
}
