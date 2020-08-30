<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\School;

class SchoolController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $schools = \App\School::paginate(30);

        return view('school.index', compact('schools'));
    }

    public function create()
    {
        return view('school.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone_number' => ['required','max:8'],
            'cellphone_number' => ['required','max:8'],
            'address' => ['required','max:250'],
            'vision' => ['nullable','max:500'],
            'mision' => ['nullable','max:500'],
            'history' => ['nullable','max:500'],
            'facebook_url' => ['nullable','max:300'],
        ]);

        school::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'cellphone_number' => $data['cellphone_number'],
            'address' => $data['address'],
            'vision'=> $data['vision'],
            'mision'=> $data['mision'],
            'history'=> $data['history'],
            'facebook_url'=> $data['facebook_url']
        ]);

        return redirect()->route('school.index')
                        ->with(['status' => 'Colegio creado correctamente.']);

    }

    public function detail($id)
    {
        $school = School::where('id', $id)->first();
                return view('school.detail', [
                    'school' => $school
                ]);
    }

    public function edit($id)
    {
        $school = School::where('id', $id)->first();
                return view('school.create', [
                    'school' => $school
                ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $school = School::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone_number' => ['nullable','max:8'],
            'cellphone_number' => ['required','max:8'],
            'address' => ['required','max:250'],
            'vision' => ['nullable','max:500'],
            'mision' => ['nullable','max:500'],
            'history' => ['nullable','max:500'],
            'facebook_url' => ['nullable','max:300'],
        ]);

        $school->name =  $data['name'];
        $school->phone_number =  $data['phone_number'];
        $school->cellphone_number =  $data['cellphone_number'];
        $school->address =  $data['address'];
        $school->vision =  $data['vision'];
        $school->mision =  $data['mision'];
        $school->history =  $data['history'];
        $school->facebook_url =  $data['facebook_url'];

        $school->update();

        return redirect()->route('school.index')
                        ->with(['status' => 'Grado actualizado correctamente.']);

    }

    public function destroy($id)
    {
        //
    }
}
