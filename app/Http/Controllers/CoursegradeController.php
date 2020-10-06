<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Coursegrade, Person, Cycle}; 

class CoursegradeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function detail($cycle_id, $grade_id)
    {
        $coursegrades=Coursegrade::where([['cycle_id',$cycle_id],['grade_id',$grade_id]])
        ->sortable()->paginate(30);

        return view('coursegrade.detail', compact('coursegrades','cycle_id', 'grade_id'));
    }

    public function menu($cycle_id = ''){

        try{
            if(empty($cycle_id)){
                $coursegrades=Coursegrade::select('grade_id','cycle_id')->distinct()
                ->orderBy('cycle_id','desc')->orderBy('grade_id','desc')
                ->paginate(30);
            }else{
                $coursegrades=Coursegrade::select('grade_id','cycle_id')->distinct()->where('cycle_id',$cycle_id)
                ->orderBy('cycle_id','desc')->orderBy('grade_id','desc')
                ->paginate(30);
            }
            
        }catch(\Exception $e){
            return view('coursegrade.menu');
        }
        return view('coursegrade.menu', compact('coursegrades'));
    }

    public function create(){
        return view('coursegrade.create');
    }

    public function store(Request $request)
    {
        $courses = $request->input('course');

        $data = $request->validate([
            'grade_id' => ['required'],
            'course_id' => ['required'],
            'cycle_id' => ['required'],
            'employee_id' => ['required'],           
        ]);


        DB::transaction(function() use ($data,$courses) {

            foreach($courses as $course){
                Coursegrade::create([
                    'cycle_id' =>  $data['cycle_id'],
                    'grade_id' => $data['grade_id'],
                    'course_id' =>  $course,
                    'employee_id' =>  $data['employee_id'],
                ]);
            }
        });
     
        return redirect()->route('coursegrade.index')
                         ->with(['status' => 'Cursos y grados asignados correctamente.']);
    }

    public function courseprofessor($cycle_id = ''){

        $user = \Auth::user();
        
        $id = $user->person_id;


        try{
            if(empty($cycle_id)){
                $coursegrades=Coursegrade::where('employee_id', $id )->sortable()->paginate(10);
            }else{
                $coursegrades=Coursegrade::where('employee_id', $id )->where('cycle_id',$cycle_id)->sortable()->paginate(10);
            }
            
        }catch(\Exception $e){
            return view('courseprofessor.index');
        }

        return view('courseprofessor.index', compact('coursegrades'));
    }

    public function edit($cycle_id,$grade_id){
        $coursegrades=Coursegrade::where([['cycle_id',$cycle_id],['grade_id',$grade_id]])
        ->sortable()->paginate(30);

        return view('coursegrade.create', compact('coursegrades','cycle_id','grade_id'));
    }

    public function update(Request $request){

        $coursegrades = sizeof($request->input('id'));
        $id = $request->input('id');
        $employee_id = $request->input('employee_id');


        for($i = 0; $i < $coursegrades; $i++){
            $datos = Coursegrade::where('id', $id[$i])
            ->update([
                'employee_id' => $employee_id[$i] ,
                ]);
        }

        $cycle_id = $request->input('cycle');
        $grade_id = $request->input('grade');

        return redirect()->action('CoursegradeController@detail', ['cycle_id' => $cycle_id,'grade_id' => $grade_id])
                        ->with(['status' => 'Curso y grado actualizado correctamente.']);

    }

    public function destroy($id){
        try{
            $coursegrade = \App\Coursegrade::where('id', $id)->first();

            $coursegrade->delete();
        }catch(\Exception $e){
            return redirect()->route('coursegrade.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
        }

        return redirect()->route('coursegrade.index')
                         ->with(['status' => 'Se elimino el registro.']);

    }

}
