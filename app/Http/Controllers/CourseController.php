<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;

class CourseController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function index () {
    $courses = \App\Course::orderBy('name','asc')->sortable()->paginate(10);

    return view('course.index', compact('courses'));
  }

  public function detail ($id) {

    $course = DB::table('course')
      ->select('id', 'name', 'status')
      ->where('id', '=', $id)
      ->get()->first();
    return view('course.create', [
      'course' => $course
    ]);
  }

  public function create() {
    return view('course.create');
  }

  public function store (Request $request) {
    $course = DB::table('course')->insert(array(
        'name' => $request->input('name')
    ));

    return redirect()->action('CourseController@index')->with('status', 'Curso creado correctamente');
  }

  public function status (Request $request) {
    $status = $request->input('status');
    $id = $request->input('id');

    $status = ($status == 'ACTIVO') ? 'INACTIVO' : 'ACTIVO';

    $course = DB::table('course')->where('id', $id)
      ->update(array(
        'status' => $status,
      ));

    return response()->json(
      [
        'data' => ['status' => $status]
      ]
    );
  }
  
  public function update (Request $request) {
    $id = $request->input('id');

    $course = DB::table('course')->where('id', $id)
      ->update(array(
        'name' => $request->input('name'),
      ));
    return redirect()->action('CourseController@index')->with('status', 'Curso actualizado correctamente');
  }

  public function destroy ($id){

    try{
      $course = \App\Course::where('id', $id)->first();

      $course->delete();
    }catch(\Exception $e){
        return redirect()->route('course.index')
        ->with(['warning' => 'No se pudo eliminar el registro, porque ya existen movimientos.']);
    }

    return redirect()->route('course.index')
                    ->with(['status' => 'Se elimino el registro.']);
    }


}
