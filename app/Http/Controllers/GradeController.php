<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Grade;

class GradeController extends Controller
{

    
    public function __construct() {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $grades = \App\Grade::sortable()->paginate(30);

        return view('grade.index', compact('grades'));
    }



    public function create()
    {
        //
        return view('grade.create');
    }

  

    public function store(Request $request)
    {
        //

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'section' => ['required']
        ]);

        Grade::create([
            'name' => $data['name'],
            'section' => $data['section']
        ]);

           
        return redirect()->route('grade.index')
                        ->with(['status' => 'Grado agregado correctamente.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        //

        $grade = \App\Grade::where('id', $id)->first();
        //        var_dump($estudiante);
        //        die();
        
                return view('grade.detail', [
                    'grade' => $grade
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       
        $grade = \App\Grade::where('id', $id)->first();
        
                return view('grade.create', [
                    'grade' => $grade
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $id = $request->input('id');
        $grade = Grade::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'section' => ['required']
        ]);
       
            $grade->name =  $data['name'];
            $grade->section =  $data['section'];

            $grade->update();

        return redirect()->route('grade.index')
                        ->with(['status' => 'Grado actualizado correctamente.']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $grade = Grade::find($id);


            
            return redirect()->route('grade.index')
            ->with(['status' => 'Grado eliminado correctamente.' ]);


    }
}
