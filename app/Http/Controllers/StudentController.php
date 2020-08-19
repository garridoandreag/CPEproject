<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Grade;
use App\Student;
class StudentController extends Controller {

    //

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $students = \App\Student::paginate(2);

//         $person = DB::table('person')->orderBy('id', 'desc')->get();

//        return view('student.index', [ 'student' => $student ]);
          return view('student.index', compact('students'));
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {

        $validate = $this->validate($request,[
            'names' => ['required', 'string', 'max:255'],
            'first_surname' => ['required', 'string', 'max:255'],
            'second_surname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:8'],
            'gender_id' => ['required', 'string', 'max:1'],

]);

        $picture = $request->file('picture');

        if ($picture) {

            //colocarle un nombre unico
            $picture_name = time() . $picture->getClientOriginalName();

            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($picture_name, File::get($picture));
        }

        $id = DB::table('person')->insertGetId(
                ['favorite_name' => $request->input('favorite_name'),
                    'names' => $request->input('names'),
                    'first_surname' => $request->input('first_surname'),
                    'second_surname' => $request->input('second_surname'),
                    'phone_number' => $request->input('phone_number'),
                    'picture' => $picture_name,
                    'gender_id' => $request->input('gender_id'),
                    'student' => '1'
                ]
        );

        $student = DB::table('student')->insert(array(
            'id' => $id,
            'birthday' => $request->input('birthday'),
            'student_code' => $request->input('student_code'),
            'grade_id' => $request->input('grade_id')
        ));
        
        
        return redirect()->route('student.index')
                        ->with(['status' => 'Estudiante creado correctamente']);
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
//        $student = DB::table('student')->where('id', '=', $id)->first();
        $student = \App\Student::where('id', $id)->first();
//        var_dump($estudiante);
//        die();

        return view('student.detail', [
            'student' => $student
        ]);
    }

    public function getSubjects(Request $request){
        if($request->ajax()){

            $subjects = Subject::where('grade_id',$request->grade_id)->get();

            foreach($subjects as $subject){
                die();

            }
            return response()->json($subjectsArray);
        }

    }

    public function edit($id) {


        $student = \App\Student::where('id', $id)->first();
        //        var_dump($estudiante);
        //        die();
        
                return view('student.create', [
                    'student' => $student
                ]);
    }

    public function update(Request $request) {
    
        //guardar el registro
        $id = $request->input('id');

                
        $picture = $request->file('picture');

        if ($picture) {

            //colocarle un nombre unico
            $picture_name = time() . $picture->getClientOriginalName();

            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($picture_name, File::get($picture));
            $person = DB::table('person')->where('id', $id)
                ->update(array(
            'favorite_name' => $request->input('favorite_name'),
            'names' => $request->input('names'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname'),
            'phone_number' => $request->input('phone_number'),
            'picture' => $picture_name,
            'gender_id' => $request->input('gender_id'),
        ));
        }else{
            $person = DB::table('person')->where('id', $id)
            ->update(array(
        'favorite_name' => $request->input('favorite_name'),
        'names' => $request->input('names'),
        'first_surname' => $request->input('first_surname'),
        'second_surname' => $request->input('second_surname'),
        'phone_number' => $request->input('phone_number'),
        'gender_id' => $request->input('gender_id'),
    ));

        }


        $student = DB::table('student')->where('id', $id)
        ->update(array(
            'birthday' => $request->input('birthday'),
            'grade_id' => $request->input('grade_id'),
            'student_code' => $request->input('student_code')
        ));






        return redirect()->action('StudentController@index')->with('status', 'Estudiante actualizado correctamente');
    }

    

}
