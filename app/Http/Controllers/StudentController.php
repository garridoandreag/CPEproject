<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Grade;

class StudentController extends Controller {

    //

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $student = \App\Student::all();
//         $person = DB::table('person')->orderBy('id', 'desc')->get();

        return view('student.index', [
            'student' => $student
        ]);
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {

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
        ));
        return redirect()->route('student.index')
                        ->with(['message' => 'Estudiante creado correctamente']);
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
            $subject = Subject::where('grade_id',$request->grade_id)->get();
            foreach($subjects as $subject){
                $subjectsArray[$subject->id] = $subject->course->name;
            }
            return response()->json($subjectsArray);
        }
    }

    

}
