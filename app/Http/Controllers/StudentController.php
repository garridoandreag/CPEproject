<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Student;

class StudentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $students = \App\Student::sortable()->paginate(30);

        return view('student.index', compact('students'));
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {


        $data = $request->validate([
            'favorite_name' => ['required', 'string', 'max:50'],
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => $data['gender_id'],
            'home_address' => ['required', 'string', 'max:250'],
            'student_code' => ['required', 'string', 'max:15'],
            'birthday' => ['required', 'date'],
            'grade_id' => ['nullable']
        ]);

        $picture = $request->file('picture');

        if ($picture) {

            //colocarle un nombre unico
            $picture_name = time() . $picture->getClientOriginalName();

            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($picture_name, File::get($picture));
        }

        DB::transaction(function() use ($data) {
            $person = Person::create([
                'favorite_name' => $data['favorite_name'],
                'names' => $data['names'],
                'first_surname' => $data['first_surname'],
                'second_surname' => $data['second_surname'],
                'phone_number' => $data['phone_number'],
                'country_code' => '320',
                'subdivision_code' => $data['subdivision_code'],
                'home_address' => $data['home_address'],
                'gender_id' => $data['gender_id'],
                'student' => '1'
            ]);

            $person->student()->create([
                'student_code' => $data['student_code'],
                'birthday' => $data['birthday']
            ]);

            $caregiver = DB::table('caregiver')->insert(array(
                'student_id' => $person->id,
                'name' => $request->input('name_caregiver'),
                'surname' => $request->input('surname_caregiver'),
                'relationship' => $request->input('relationship'),
                'phone_number' => $request->input('phone_number_caregiver'),

            ));
    });       

      return redirect()->route('student.index')
                        ->with(['status' => 'Estudiante creado correctamente']);
    }

    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id) {
        $student = \App\Student::where('id', $id)->first();

        return view('student.detail', [
            'student' => $student
        ]);
    }

    public function edit($id) {

        $student = \App\Student::where('id', $id)->first();

                return view('student.create', [
                    'student' => $student
                ]);
    }

    public function update(Request $request) {

        $id = $request->input('id');
        $person = Person::find($id);

        $picture = $request->file('picture');

        $data = $request->validate([
            'favorite_name' => ['required', 'string', 'max:50'],
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'gender_id' => $data['gender_id'],
            'home_address' => ['required', 'string', 'max:250'],
            'student_code' => ['required', 'string', 'max:15'],
            'birthday' => ['required', 'date'],
            'grade_id' => ['nullable']
        ]);

        $person->favorite_name =  $data['favorite_name'];
        $person->names =  $data['names'];
        $person->first_surname =  $data['first_surname'];
        $person->second_surname =  $data['second_surname'];
        $person->phone_number =  $data['phone_number'];
        $person->subdivision_code =  $data['subdivision_code'];
        $person->home_address =  $data['home_address'];
        $person->student->student_code =  $data['student_code'];
        $person->student->birthday =  $data['birthday'];
        $person->student->grade_id =  $data['grade_id'];

        if ($picture) {
            //colocarle un nombre unico
            $picture_name = time() . $picture->getClientOriginalName();
            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($picture_name, File::get($picture));

            $person->picture = $picture_name;
        }

        $person->update();
        
        $caregiver = DB::table('caregiver')->where('student_id', $id)
        ->update(array(
            'name' => $request->input('name_caregiver'),
            'surname' => $request->input('surname_caregiver'),
            'relationship' => $request->input('relationship'),
            'phone_number' => $request->input('phone_number_caregiver'),

        ));

        return redirect()->action('StudentController@index')->with('status', 'Estudiante actualizado correctamente');
    }



}
