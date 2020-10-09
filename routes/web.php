<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/
/*Route::group(['middleware' => ['auth', '1']], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});
*/


Auth::routes();

Route::get('/home', function () {
    return view('home');
})->middleware('auth');
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::post('/search-person', 'PersonController@searchPersonWithName')->name('search-person');;
Route::get('/admin', function () {
    return view('admin.administration');
})->name('admin.admin')->middleware('auth','1');

Route::get('/configuration','UserController@config')->name('config');

Route::group(['prefix' => 'user'], function() {
    Route::post('update','UserController@update')->name('user.update');
    Route::get('/','UserController@index')->name('user.index');
    Route::get('detail/{id}', 'UserController@detail')->name('user.detail');
    Route::get('/picture/{filename}','UserController@getImage')->name('user.picture');

});

Route::get('/school/logo/{filename}', 'ShowLogoController@getImage')->name('school.logo');

Route::group(['prefix' => 'student'], function() {
    Route::get('create', 'StudentController@create')->name('student.create');
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::post('store', 'StudentController@store')->name('student.store');
    Route::get('edit/{id}', 'StudentController@edit')->name('student.edit');
    Route::post('update', 'StudentController@update')->name('student.update');
    Route::get('picture/{filename}','StudentController@getImage')->name('student.picture');
    Route::get('detail/{id}', 'StudentController@detail')->name('student.detail');
    Route::get('/Coursegrades', 'StudentController@getCoursegrades');
    Route::post('/search-student', 'StudentController@searchStudentByCode')->name('student.search-student');
});

Route::group(['prefix' => 'course'], function() {
  Route::get('/', 'CourseController@index')->name('course.index');
  Route::get('/create', 'CourseController@create')->name('course.create');
  Route::post('/store', 'CourseController@store')->name('course.store');
  Route::get('/detail/{id}', 'CourseController@detail')->name('course.detail');
  Route::post('/update', 'CourseController@update')->name('course.udpate');
  Route::post('/status', 'CourseController@status')->name('course.status');
  Route::get('/destroy/{id}', 'CourseController@destroy')->name('course.destroy');
});


Route::group(['prefix' => 'tutor'], function() {
    Route::get('create', 'TutorController@create')->name('tutor.create');
    Route::get('/', 'TutorController@index')->name('tutor.index');
    Route::post('store', 'TutorController@store')->name('tutor.store');
    Route::get('edit/{id}', 'TutorController@edit')->name('tutor.edit');
    Route::get('detail/{id}', 'TutorController@detail')->name('tutor.detail');
    Route::post('update', 'TutorController@update')->name('tutor.update');
    Route::post('/search-tutor', 'TutorController@searchTutorByDPI')->name('tutor.search-tutor');
});

Route::group(['prefix' => 'grade'], function() {
    Route::get('crear', 'GradeController@create')->name('grade.create');
    Route::get('/', 'GradeController@index')->name('grade.index');
    Route::post('store', 'GradeController@store')->name('grade.store');
    Route::get('edit/{id}', 'GradeController@edit')->name('grade.edit');
    Route::get('detail/{id}', 'GradeController@detail')->name('grade.detail');
    Route::post('update', 'GradeController@update')->name('grade.update');
    Route::get('delete/{id}', 'GradeController@destroy')->name('grade.destroy');
});

Route::group(['prefix' => 'school'], function() {
    Route::get('create', 'SchoolController@create')->name('school.create');
    Route::get('/', 'SchoolController@index')->name('school.index');
    Route::post('store', 'SchoolController@store')->name('school.store');
    Route::get('detail/{id}', 'SchoolController@detail')->name('school.detail');
    Route::get('edit/{id}', 'SchoolController@edit')->name('school.edit');
    Route::post('update', 'SchoolController@update')->name('school.update');
});

Route::group(['prefix' => 'cycle'], function() {
    Route::get('create', 'CycleController@create')->name('cycle.create');
    Route::get('/', 'CycleController@index')->name('cycle.index');
    Route::post('store', 'CycleController@store')->name('cycle.store');
    Route::get('detail/{id}', 'CycleController@detail')->name('cycle.detail');
    Route::get('edit/{id}', 'CycleController@edit')->name('cycle.edit');
    Route::post('update', 'CycleController@update')->name('cycle.update');
});

Route::group(['prefix' => 'announcement'], function() {
    Route::get('create', 'AnnouncementController@create')->name('announcement.create');
    Route::get('/', 'AnnouncementController@index')->name('announcement.index');
    Route::post('store', 'AnnouncementController@store')->name('announcement.store');
    Route::get('detail/{id}', 'AnnouncementController@detail')->name('announcement.detail');
    Route::get('edit/{id}', 'AnnouncementController@edit')->name('announcement.edit');
    Route::post('update', 'AnnouncementController@update')->name('announcement.update');
});

Route::group(['prefix' => 'paymentcategory'], function() {
    Route::get('create', 'PaymentcategoryController@create')->name('paymentcategory.create');
    Route::get('/', 'PaymentcategoryController@index')->name('paymentcategory.index');
    Route::post('store', 'PaymentcategoryController@store')->name('paymentcategory.store');
    Route::get('detail/{id}', 'PaymentcategoryController@detail')->name('paymentcategory.detail');
    Route::get('edit/{id}', 'PaymentcategoryController@edit')->name('paymentcategory.edit');
    Route::post('update', 'PaymentcategoryController@update')->name('paymentcategory.update');
});

Route::group(['prefix' => 'employee'], function() {
    Route::get('create', 'EmployeeController@create')->name('employee.create');
    Route::get('/', 'EmployeeController@index')->name('employee.index');
    Route::post('store', 'EmployeeController@store')->name('employee.store');
    Route::get('detail/{id}', 'EmployeeController@detail')->name('employee.detail');
    Route::get('edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::post('update', 'EmployeeController@update')->name('employee.update');
});

Route::group(['prefix' => 'event'], function () {
  Route::get('/', 'EventController@index')->name('event.index');
});

// esto esta pendiente aún
Route::group(['prefix' => 'coursegrade'], function() {
    Route::get('create', 'CoursegradeController@create')->name('coursegrade.create');
    Route::get('detail/{cycle_id}/{grade_id}', 'CoursegradeController@detail')->name('coursegrade.detail');
    Route::get('/menu/{cycle_id?}', 'CoursegradeController@menu')->name('coursegrade.menu');
    Route::post('store', 'CoursegradeController@store')->name('coursegrade.store');
    Route::get('edit/{cycle_id}/{grade_id}', 'CoursegradeController@edit')->name('coursegrade.edit');
    Route::post('update', 'CoursegradeController@update')->name('coursegrade.update');
    Route::get('destroy/{id}', 'CoursegradeController@destroy')->name('coursegrade.destroy');
});

Route::group(['prefix' => 'subjectstudent'], function() {
    Route::get('create/{student_id?}', 'SubjectstudentController@create')->name('subjectstudent.create');
    Route::get('inscription/{student_id}', 'SubjectstudentController@inscription')->name('subjectstudent.inscription');
    Route::get('/', 'SubjectstudentController@index')->name('subjectstudent.index');
    Route::get('/reportcard/{cycle_id}/{student_id}', 'SubjectstudentController@reportcard')->name('subjectstudent.reportcard');//eliminar
    Route::post('store', 'SubjectstudentController@store')->name('subjectstudent.store');
    Route::get('detail/{student_id}/{cycle_id}/{grade_id}', 'SubjectstudentController@detail')->name('subjectstudent.detail');
    Route::get('destroy/{student_id}/{cycle_id}/{grade_id}', 'SubjectstudentController@destroy')->name('subjectstudent.destroy');
});

Route::group(['prefix' => 'homework'], function() {
    Route::get('edit/{activity_id}', 'HomeworkController@edit')->name('homework.edit');
    Route::get('detail/{activity_id}', 'HomeworkController@detail')->name('homework.detail');
    Route::post('update', 'HomeworkController@update')->name('homework.update');
    Route::post('store', 'HomeworkController@store')->name('homework.store');
});

Route::group(['prefix' => 'courseprofessor'], function() {
    Route::get('/{cycle_id?}', 'CoursegradeController@courseprofessor')->name('courseprofessor.index');
    Route::get('activity/{coursegrade_id?}/{unit_id?}', 'ActivityController@courseprofessoractivity')->name('courseprofessor.activity');
});

Route::group(['prefix' => 'activity'], function() {
    Route::get('create/{employee_id?}', 'ActivityController@create')->name('activity.create');
    Route::post('store', 'ActivityController@store')->name('activity.store');
    Route::get('detail/{id}', 'ActivityController@detail')->name('activity.detail');
    Route::get('edit/{id}', 'ActivityController@edit')->name('activity.edit');
    Route::post('update', 'ActivityController@update')->name('activity.update');
});

Route::group(['prefix' => 'payment'], function() {
    Route::get('create', 'PaymentController@create')->name('payment.create');
    Route::get('/', 'PaymentController@index')->name('payment.index');
    Route::get('detail/{id}', 'PaymentController@detail')->name('payment.detail');
    Route::post('store', 'PaymentController@store')->name('payment.store');
    

});

Route::name('reportcardpdf')->get('/reportcardpdf/{cycle_id}/{student_id}','SubjectstudentController@reportcardPDF');