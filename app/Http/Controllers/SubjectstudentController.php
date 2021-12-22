<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\{Subjectstudent, Coursegrade, School, Employee}; 

class SubjectstudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $subjectstudents= Subjectstudent::sortable()->paginate(30);

        return view('subjectstudent.index', compact('subjectstudents'));
    }

    public function inscription($student_id)
    {
        $subjectstudents=Subjectstudent::select('student_id','grade_id','cycle_id','status', DB::raw('MIN(id) as id'))
                                        ->groupBy('student_id','grade_id','cycle_id','status')
                                        ->where('student_id', $student_id)->sortable()->paginate(30);

        return view('subjectstudent.inscription', compact('subjectstudents','student_id'));
    }


    public function reportcardPDF($cycle_id='',$student_id=''){

        try{

        $now = Carbon::now();

        $school = School::find(1);

        $student = DB::table('person')->where('id','like',$student_id)->get();

        $subject = Subjectstudent::where('cycle_id',$cycle_id)->where('student_id',$student_id)->first();
        $grade = $subject->coursegrade->grade;
        $scoretype = $subject->coursegrade->grade->scoretype;
        $cycle= $subject->coursegrade->cycle;

        if($scoretype == 'C'){
            $reports = DB::table('reportcard2')
            ->where('reportcard2.student_id','like',$student_id)
            ->where('reportcard2.cycle_id','like',$cycle_id)
            ->orderBy('reportcard2.courseorder','asc')
            ->get();
        }else {
            $reports = DB::table('reportcard')
            ->where('reportcard.student_id','like',$student_id)
            ->where('reportcard.cycle_id','like',$cycle_id)
            ->orderBy('reportcard.courseorder','asc')
            ->get();
        }
        
        $professor_id= collect(DB::select('SELECT getProfessorID(?,?) AS professor_id', [$student_id,$cycle_id]))->first()->professor_id;
        $professor = DB::table('person')
                    ->where('id','like',$professor_id)
                    ->get();

        /*$professor= DB::table('reportprofessor')
        ->join('person','reportprofessor.employee_id','person.id')
        ->where('reportprofessor.student_id','like',$student_id)
        ->where('reportprofessor.cycle_id','like',$cycle_id)
        ->get();*/

        $pdf = \PDF::loadView('/report/reportcardpdf',compact('reports','school','student','professor','grade','cycle','now'));
        }catch(\Exception $e){
            return redirect()->action('SubjectstudentController@reportcard', ['cycle_id' => $cycle_id,'student_id' => $student_id]) 
                          ->with(['warning' => 'No hay datos']);
        }
        
        return $pdf->download('boletaNotas.pdf');
    }

    public function reportcard($cycle_id='',$student_id='')
    {   
       
        try{
        try{
            $subject = Subjectstudent::where('cycle_id',$cycle_id)->where('student_id',$student_id)->first();
            $grade = $subject->coursegrade->grade;
            $scoretype = $subject->coursegrade->grade->scoretype;
            $cycle= $subject->coursegrade->cycle;
        }catch(\Exception $e){
            $grade = '';
            $cycle= '';
        }

        if($scoretype == 'C'){
            $reports = DB::table('reportcard2')
            ->where('reportcard2.student_id','like',$student_id)
            ->where('reportcard2.cycle_id','like',$cycle_id)
            ->orderBy('reportcard2.courseorder','asc')
            ->get();
        }else{
            $reports = DB::table('reportcard')
            ->where('reportcard.student_id','like',$student_id)
            ->where('reportcard.cycle_id','like',$cycle_id)
            ->orderBy('reportcard.courseorder','asc')
            ->get();
        }

        $student = DB::table('person')->where('id','like',$student_id)->get();

        $professor_id= collect(DB::select('SELECT getProfessorID(?,?) AS professor_id', [$student_id,$cycle_id]))->first()->professor_id;
        $professor = DB::table('person')
                    ->where('id','like',$professor_id)
                    ->get();
    }catch(\Exception $e){
        return back()->with(['warning' => 'No se encontró una inscripción en el ciclo indicado.']);
        abort(204);
    }               
        return view('subjectstudent.reportcard', compact('reports','student_id','cycle_id','student','professor','grade','cycle'));
    }

    public function create($student_id)
    {
                return view('subjectstudent.create', [
                    'student_id' => $student_id
                ]);
        
    }

    public function store(Request $request)
    {
        $grade_id = $request->input('grade_id');
        $cycle_id = $request->input('cycle_id');
        $student_id = $request->input('student_id');

        $data = $request->validate([
            'grade_id' => ['required'],
            'cycle_id' => ['required'],     
        ]);


        foreach(Coursegrade::where('grade_id',$grade_id)->where('cycle_id',$cycle_id)->where('status','ACTIVO')->cursor() as $coursegrade){
            Subjectstudent::firstOrCreate([
                'student_id' =>  $student_id,
                'grade_id' => $data['grade_id'],
                'coursegrade_id' => $coursegrade->id,
                'cycle_id' =>  $data['cycle_id']
            ]);
        }

        
     
        return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
                         ->with(['status' => 'Inscripción registrada con éxito.']);
    }

    public function detail($student_id,$cycle_id,$grade_id)
    {
        $subjectstudent=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->first();

        $subjects=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->get();
        
        return view('subjectstudent.detail', [
            'student_id' => $student_id,'subjectstudent' => $subjectstudent,'subjects' => $subjects
        ]);
    }

    public function edit($student_id,$cycle_id,$grade_id)
    {
        $subjectstudent=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->first();

        $subjects=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->get();
   
        return view('subjectstudent.create', [
            'student_id' => $student_id,'subjectstudent' => $subjectstudent,'subjects' => $subjects
        ]);
        
    }

    public function update(Request $request)
    {
        $grade_id = $request->input('grade_id');
        $cycle_id = $request->input('cycle_id');
        $student_id = $request->input('student_id');
        $courses = $request->input('course_id');
        


        if(isset($courses)){
        foreach( $courses as $course_id){

            $coursegrade = Coursegrade::where('grade_id',$grade_id)->where('cycle_id',$cycle_id)->where('course_id',$course_id)->first();

            Subjectstudent::updateOrCreate([
                'student_id' =>  $student_id,
                'grade_id' => $grade_id,
                'cycle_id' =>  $cycle_id,
                'coursegrade_id' => $coursegrade->id,],
                ['status' => 'ACTIVO']
            );

        }}

        return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
                         ->with(['status' => 'Inscripción actualizada con éxito.']);
        
     }

     public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');

        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

        $query = Subjectstudent::where('id',$id)->get();

        //DB::table('subjectstudent')->where('student_id', $query->student_id)->where('grade_id', $query->grade_id)->where('cycle_id', $query->cycle_id)->get();
        /*$change->status = $status;
        $change->update();*/

        DB::select('call SP_UPDATE_SUBJECTSTUDENT_STATUS(?, ?)',array($id, $status));

        $subjectstudent = DB::table('subjectstudent')->where('id', $id)
          ->update(array(
            'status' => $status,
          ));

        return response()->json(
          [
            'data' => ['status' => $status]
          ]
        );
    }
    
    

    public function destroycourse($student_id,$cycle_id,$grade_id,$coursegrade_id){

        $subjectstudent=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->first();

        $subjects=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->get();

        try{
            $subjectdelete=Subjectstudent::where('student_id', $student_id)->where('cycle_id', $cycle_id)->where('grade_id', $grade_id)->where('coursegrade_id', $coursegrade_id)->delete();

        }catch(\Exception $e){
            return view('subjectstudent.detail', [
                'student_id' => $student_id,'subjectstudent' => $subjectstudent,'subjects' => $subjects
            ])->with(['status' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);

        }
        return view('subjectstudent.detail', [
            'student_id' => $student_id,'subjectstudent' => $subjectstudent,'subjects' => $subjects
        ])->with(['status' => 'Se elimino el registro.']);

    }

    public function destroy($student_id,$cycle_id,$grade_id)
    {
        try{
                $subjectstudents = DB::table('Subjectstudent')
                                    ->where([
                                        ['student_id','=',$student_id],
                                        ['cycle_id','=', $cycle_id],
                                        ['grade_id','=',$grade_id],
                                        ])->delete();
                //var_dump($subjectstudents);
                //die();

               //$subjectstudents->delete();

          }catch(\Exception $e){
              return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
              ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
          }
      
          return redirect()->action('SubjectstudentController@inscription', ['student_id' => $student_id]) 
                          ->with(['status' => 'Se elimino el registro.']);
    }
      
}

