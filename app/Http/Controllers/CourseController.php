<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function index () {
    $courses = DB::table('course')
      ->select('id', 'name', 'status')
      ->get();
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
}
