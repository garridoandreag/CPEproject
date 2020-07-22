<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller {

    //
    public function index() {
        $estudiante = DB::table('estudiante')->orderBy('id_estudiante', 'desc')->get();

        return view('estudiante.index', [
            'estudiante' => $estudiante
        ]);
    }

    public function detail($id) {
        $estudiante = DB::table('estudiante')->where('id_estudiante', '=', $id)->first();

//        var_dump($estudiante);
//        die();

        return view('estudiante.detail', [
            'estudiante' => $estudiante
        ]);
    }

    public function create() {


        return view('estudiante.create');
    }

    public function save(Request $request) {
        //guardar el registro

        $estudiante = DB::table('estudiante')->insert(array(
            'nombre1' => $request->input('nombre1'),
            'nombre2' => $request->input('nombre2'),
            'nombre3' => $request->input('nombre3'),
            'apellido1' => $request->input('apellido1'),
            'apellido2' => $request->input('apellido2'),
            'codigo_estudiante' => $request->input('codigo_estudiante'),
            'fecha_inscripcion' => $request->input('fecha_inscripcion'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'email' => $request->input('email')
        ));

        return redirect()->action('EstudianteController@index')->with('status', 'Estudiante creado correctamente');
    }

    public function delete($id) {
        $estudiante = DB::table('estudiante')->where('id_estudiante', $id)->delete();

        return redirect()->action('EstudianteController@index')->with('status', 'Estudiante eliminado correctamente');
    }

    public function edit($id) {
        $estudiante = DB::table('estudiante')->where('id_estudiante', $id)->first();

        return view('estudiante.create', [
            'estudiante' => $estudiante
        ]);
    }

    public function update(Request $request) {
        //guardar el registro
        $id = $request->input('id');
        $estudiante = DB::table('estudiante')->where('id_estudiante', $id)
                ->update(array(
            'nombre1' => $request->input('nombre1'),
            'nombre2' => $request->input('nombre2'),
            'nombre3' => $request->input('nombre3'),
            'apellido1' => $request->input('apellido1'),
            'apellido2' => $request->input('apellido2'),
            'codigo_estudiante' => $request->input('codigo_estudiante'),
            'fecha_inscripcion' => $request->input('fecha_inscripcion'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'email' => $request->input('email')
        ));

        return redirect()->action('EstudianteController@index')->with('status', 'Estudiante actualizado correctamente');
    }

}
