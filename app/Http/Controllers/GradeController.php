<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\{Grade, Course, Pensum};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        try{
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'section' => ['required'],
            'scoretype' => ['required']
        ]);

        DB::transaction(function() use ($data, $request) {
        $grade = Grade::create([
            'name' => $data['name'],
            'section' => $data['section'],
            'scoretype' => $data['scoretype']
        ]);

        $image_path = $request->file('image_path');
        if($image_path){
            $image_full_path = time().$image_path->getClientOriginalName();

            Storage::disk('grade')->put($image_full_path, File::get($image_path));

            $grade->image_path = $image_full_path;
            $grade->update();
        }

        $courses = Course::get();
        $pensum = Pensum::get();
    
        foreach($courses as $course){
                    
          Pensum::firstOrCreate([
              'grade_id' => $grade->id,
              'course_id' => $course->id,],
              ['status' => 'INACTIVO'
          ]);
      }
    });


    }catch(\Exception $e){
        return redirect()->route('grade.index')
        ->with(['warning' => 'No se pudo crear el grado.']);

    }
        return redirect()->route('grade.index')
                        ->with(['status' => 'Grado agregado correctamente.']);

    }

    public function getImage($id){

        $grade = Grade::where('id', $id)->first();

        $file = Storage::disk('grade')->get($grade->image_path);

        return new Response($file,200);
    }


    public function detail($id)
    {
        $grade = \App\Grade::where('id', $id)->first();

                return view('grade.detail', [
                    'grade' => $grade
                ]);
    }

    public function edit($id)
    {
        $grade = \App\Grade::where('id', $id)->first();
        
                return view('grade.create', [
                    'grade' => $grade
                ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $grade = Grade::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'section' => ['required'],
            'scoretype' => ['required'],
        ]);
       
            $grade->name =  $data['name'];
            $grade->section =  $data['section'];
            $grade->scoretype =  $data['scoretype'];

            $image_path = $request->file('image_path');
            if($image_path){
                $image_full_path = time().$image_path->getClientOriginalName();

                Storage::disk('grade')->put($image_full_path, File::get($image_path));

                $grade->image_path = $image_full_path;
            }

            $grade->update();

        return redirect()->route('grade.index')
                        ->with(['status' => 'Grado actualizado correctamente.']);
    }


    public function status (Request $request) {
        $status = $request->input('status');
        $id = $request->input('id');
    
        $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';
    
        $course = DB::table('grade')->where('id', $id)
          ->update(array(
            'status' => $status,
          ));
    
        return response()->json(
          [
            'data' => ['status' => $status]
          ]
        );
      }

    public function destroy($id)
    {
        try{
            $grade = Grade::find($id);

            DB::transaction(function() use($grade){
                Pensum::where(['grade_id' => $grade->id])->delete();

                $grade->delete();
            });
       }catch(\Exception $e){
            return redirect()->route('grade.index')
            ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
      }
            return redirect()->route('grade.index')
            ->with(['status' => 'Grado eliminado correctamente.' ]);
    }
}
