<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\{Tutor, Person};


class TutorController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        //

        $tutors = \App\Tutor::paginate(30);

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

        $data = $request->validate([
            'names' => ['required', 'string', 'max:50'],
            'first_surname' => ['required', 'string', 'max:50'],
            'second_surname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'max:8'],
            'cellphone_number' => ['nullable', 'string', 'max:8'],
            'subdivision_code' => ['required'],
            'home_address' => ['required', 'string', 'max:250'],
            'dpi' => ['required', 'string', 'max:13'],
            'occupation' => ['required', 'string', 'max:50'],
        ]);

        

        DB::transaction(function() use ($data) {
            $person = Person::create([
                'names' => $data['names'],
                'first_surname' => $data['first_surname'],
                'second_surname' => $data['second_surname'],
                'phone_number' => $data['phone_number'],
                'cellphone_number' => $data['cellphone_number'],
                'country_code' => '320',
                'subdivision_code' => $data['subdivision_code'],
                'home_address' => $data['home_address'],
                'gender_id' => 'M',
                'tutor' => '1'
            ]);
    
            $person->tutor()->create([
                'dpi' => $data['dpi'],
                'occupation' => $data['occupation']
            ]);



        });

        return redirect()->route('tutor.index');



    }


    public function detail($id)
    {
        //
        $tutor = \App\Tutor::where('id', $id)->first();
        //        var_dump($estudiante);
        //        die();
        
                return view('tutor.detail', [
                    'tutor' => $tutor
                ]);
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
