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

    public function index()
    {
        $coursegrades= Coursegrade::sortable()->paginate(30);

        return view('coursegrade.index', compact('coursegrades'));
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


    public function detail($id){
        $coursegrade = \App\Coursegrade::where('id', $id)->first();

        return view('coursegrade.detail', [
            'coursegrade' => $coursegrade
        ]);

    }

    public function courseprofessor($cycle_id = ''){

        $user = \Auth::user();
        
        $id = $user->person_id;

        try{
            if(empty($cycle_id)){
                $coursegrades=Coursegrade::where('employee_id', $id )->firstOrFail()->sortable()->paginate(10);
            }else{
                $coursegrades=Coursegrade::where('employee_id', $id )->where('cycle_id',$cycle_id)->firstOrFail()->sortable()->paginate(10);
            }
            
        }catch(\Exception $e){
            return view('courseprofessor.index');
        }

        return view('courseprofessor.index', compact('coursegrades'));
    }

    public function edit($id){
        $coursegrade = \App\Coursegrade::where('id', $id)->first();

        return view('coursegrade.create', [
            'coursegrade' => $coursegrade
        ]);
    }

    public function update(Request $request){

        $id = $request->input('id');
        $coursegrade = Coursegrade::find($id);

        $data = $request->validate([
            'grade_id' => ['required'],
            'course_id' => ['required'],
            'cycle_id' => ['required'],
            'employee_id' => ['required'],           
        ]);

        $coursegrade->grade_id =  $data['grade_id'];
        $coursegrade->course_id =  $data['course_id'];
        $coursegrade->cycle_id =  $data['cycle_id'];
        $coursegrade->employee_id =  $data['employee_id'];

        $coursegrade->update();

        return redirect()->route('coursegrade.index')
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
