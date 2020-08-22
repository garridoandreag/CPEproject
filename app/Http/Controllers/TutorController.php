<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //

        $students = \App\Student::paginate(30);

        //         $person = DB::table('person')->orderBy('id', 'desc')->get();
        
        //        return view('student.index', [ 'student' => $student ]);
                  return view('tutor.index', compact('tutors'));
    }

    public function create()
    {
        //
        return view('tutor.create');
    }


    public function store(Request $request)
    {
        //

        $data = $request()->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'cellphone_number' => ['required', 'string', 'max:8'],
            'home_address' => ['required', 'string', 'max:250'],
            'occupation' => ['required', 'string', 'max:50'],
            

            




        ])
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
