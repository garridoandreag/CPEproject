<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {


//    $estudiantes = App\Estudiante::all();
//
////     $estudiantes = App\Estudiante::find(1)->encargados()->orderBy('id_estudiante')->get();
//    foreach ($estudiantes as $estudiante) {
//        echo $estudiante->nombre1 . "<br/>";
//        echo $estudiante->nombre2 . "<br/>";
//        echo $estudiante->apellido1 . "<br/>";
//
//
//        echo '<h4>ENCARGADOS:</h4>';
//        echo count($estudiante->encargados)."<br/>";
//        foreach ($estudiante->encargados as $encargado) {
//            echo $encargado->nombre1 . ' ' . $encargado->apellido1 . "<br/>";
//            echo $encargado->direccion . "<br/>";
////            echo $encargado->usuario->name . "<br/>";
//        }
//
//        echo "<hr/>";
//    }
//    $people = App\Person::all();
//
//    foreach ($people as $person) {
//        echo $person->first_name . "<br/>";
//
//        echo $person->gender->name . "<br/>";
//
//        IF ($person->employee == 1) {
//            echo $person->person_employee->job . "<br/>";
//        }
//        // var_dump($person);
//        foreach ($person->user as $user) {
//            echo $user->email . "<br/>";
//        }
//            echo "<hr/>";
//    }



    return view('welcome');
});

Route::group(['middleware' => ['auth', '1']], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});




Route::get('/home', function () {
    return view('home');
});



//Route::group(['prefix' => 'estudiante'], function() {
//
//
//    Route::get('index', 'EstudianteController@index');
//    Route::get('detail/{id}', 'EstudianteController@detail');
//    Route::get('create', 'EstudianteController@create');
//    Route::post('save', 'EstudianteController@save');
//    Route::get('delete/{id}', 'EstudianteController@delete');
//    Route::get('edit/{id}', 'EstudianteController@edit');
//    Route::post('update', 'EstudianteController@update');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');

Route::get('/user/picture/{filename}','UserController@getImage')->name('user.picture');

Route::group(['prefix' => 'estudiante'], function() {
    Route::get('crear', 'StudentController@create')->name('student.create');
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::post('store', 'StudentController@store')->name('student.store');
    Route::get('picture/{filename}','StudentController@getImage')->name('student.picture');
    Route::get('detalle/{id}', 'StudentController@detail')->name('student.detail');
    Route::get('/subjects', 'StudentController@getSubjects');
});