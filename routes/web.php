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

/*Route::group(['middleware' => ['auth', '1']], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});
*/

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
Route::post('/search-person', 'PersonController@searchPersonWithName');

Route::get('/administracion', function () {
    return view('admin.administracion');
})->name('admin.admin');

Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');

Route::get('/user/picture/{filename}','UserController@getImage')->name('user.picture');

Route::group(['prefix' => 'estudiante'], function() {
    Route::get('create', 'StudentController@create')->name('student.create');
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::post('store', 'StudentController@store')->name('student.store');
    Route::get('edit/{id}', 'StudentController@edit')->name('student.edit');
    Route::post('update', 'StudentController@update')->name('student.update');
    Route::get('picture/{filename}','StudentController@getImage')->name('student.picture');
    Route::get('detail/{id}', 'StudentController@detail')->name('student.detail');
    Route::get('/subjects', 'StudentController@getSubjects');
});

Route::group(['prefix' => 'course'], function() {
  Route::get('/', 'CourseController@index')->name('course.index');
  Route::get('/create', 'CourseController@create')->name('course.create');
  Route::post('/store', 'CourseController@store')->name('course.store');
  Route::get('/detail/{id}', 'CourseController@detail')->name('course.detail');
  Route::post('/update', 'CourseController@update')->name('course.udpate');
  Route::post('/status', 'CourseController@status')->name('course.status');
});

Route::group(['prefix' => 'padre'], function() {
    Route::get('create', 'TutorController@create')->name('tutor.create');
    Route::get('/', 'TutorController@index')->name('tutor.index');
    Route::post('store', 'TutorController@store')->name('tutor.store');
    Route::get('detail/{id}', 'TutorController@detail')->name('tutor.detail');
    Route::post('update', 'TutorController@update')->name('tutor.update');
});

Route::group(['prefix' => 'grado'], function() {
    Route::get('crear', 'GradeController@create')->name('grade.create');
    Route::get('/', 'GradeController@index')->name('grade.index');
    Route::post('store', 'GradeController@store')->name('grade.store');
    Route::get('edit/{id}', 'GradeController@edit')->name('grade.edit');;
    Route::get('detail/{id}', 'GradeController@detail')->name('grade.detail');
    Route::post('update', 'GradeController@update')->name('grade.update');
    Route::get('delete/{id}', 'GradeController@destroy')->name('grade.destroy');
});

Route::group(['prefix' => 'colegio'], function() {
    Route::get('create', 'SchoolController@create')->name('school.create');
    Route::get('/', 'SchoolController@index')->name('school.index');
    Route::post('store', 'SchoolController@store')->name('school.store');
    Route::get('detail/{id}', 'SchoolController@detail')->name('school.detail');
});

Route::group(['prefix' => 'event'], function () {
  Route::get('/', 'EventController@index')->name('event.index');
});
