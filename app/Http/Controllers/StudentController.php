<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller {

    //

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $student = DB::table('student')->orderBy('id', 'desc')->get();

        return view('student.index', [
            'student' => $student
        ]);
    }

    public function create() {
        return view('student.create');
    }

    public function save(Request $request) {
        //guardar el registro
//        
//    var_dump($student);
////    die();
//        $num = DB::select('SELECT max(id) FROM person') ;

          $num=\DB::table('person')->max('id');

        $numero = $num + 1;

        $student = DB::table('person')->insert(array(
            'id' => $numero,
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname'),
            'phone_number' => $request->input('phone_number'),
            'cellphone_number' => $request->input('cellphone_number'),
            'birthday' => $request->input('birthday'),
            'gender_id' => $request->input('gender_id'),
            'student' => '1'
        ));


//        $picture = $request->file('picture');
//        if ($picture) {
//            //colocarle un nombre unico
//            $picture_name = time() . $picture->getClientOriginalName();
//            //guardar en la carpeta storage (storage/app/users)
//            Storage::disk('users')->put($picture_name, File::get($picture));
//            //setear el nombre de la imagen en el objeto
//            $person->picture = $picture_name;
//            $person->save();
//        }
        return redirect()->action('StudentController@index')->with('status', 'Estudiante creado correctamente');
    }

}
