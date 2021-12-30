<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});*/

/*Route::group(['middleware' => ['auth', '1']], function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
});
*/





Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

//Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::post('/search-person', 'PersonController@searchPersonWithName')->name('search-person')->middleware('auth');
Route::get('/admin', function () {
    return view('admin.administration');
})->name('admin.admin')->middleware('auth','admin');

Route::get('/configuration','UserController@config')->name('config')->middleware('auth','userstatus');

Route::group(['prefix' => 'user'], function() {
    Route::post('update','UserController@update')->name('user.update');
    Route::get('/','UserController@index')->name('user.index')->middleware('auth');
    Route::get('detail/{id}', 'UserController@detail')->name('user.detail')->middleware('auth');
    Route::get('edit/{id}', 'UserController@edit')->name('user.edit')->middleware('auth');
    Route::post('updateToUser','UserController@updateToUser')->name('user.updateToUser')->middleware('auth');
    Route::get('/picture/{filename}','UserController@getImage')->name('user.picture');
    Route::get('destroy/{id}', 'UserController@destroy')->name('user.destroy')->middleware('auth','admin');
    Route::post('/status', 'UserController@status')->name('user.status');
});

Route::get('/school/logo/{filename}', 'ShowLogoController@getImage')->name('school.logo');

Route::group(['prefix' => 'student'], function() {
    Route::get('create', 'StudentController@create')->name('student.create')->middleware('auth','admin');
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::post('store', 'StudentController@store')->name('student.store')->middleware('auth','userstatus','admin');
    Route::get('edit/{id}', 'StudentController@edit')->name('student.edit')->middleware('auth','userstatus','admin');
    Route::post('update', 'StudentController@update')->name('student.update')->middleware('auth','userstatus','admin');
    Route::get('picture/{filename}','StudentController@getImage')->name('student.picture')->middleware('auth','userstatus');
    Route::get('detail/{id}', 'StudentController@detail')->name('student.detail')->middleware('auth','userstatus');
    Route::get('/Coursegrades', 'StudentController@getCoursegrades');
    Route::post('/search-student', 'StudentController@searchStudentBySurname')->name('student.search-student');
    Route::get('grade', 'StudentController@grade')->name('student.grade');
    Route::get('list/{grade_id}/{cycle_id?}', 'StudentController@list')->name('student.list')->middleware('checkgradeprofessor');
    Route::post('/status', 'StudentController@status')->name('student.status');
    Route::get('/destroy/{id}', 'StudentController@destroy')->name('student.destroy')->middleware('auth','userstatus','admin');
});

Route::group(['prefix' => 'course'], function() {
  Route::get('/', 'CourseController@index')->name('course.index');
  Route::get('/create', 'CourseController@create')->name('course.create')->middleware('auth');
  Route::post('/store', 'CourseController@store')->name('course.store');
  Route::get('/detail/{id}', 'CourseController@detail')->name('course.detail');
  Route::post('/update', 'CourseController@update')->name('course.udpate');
  Route::post('/status', 'CourseController@status')->name('course.status');
  Route::get('/destroy/{id}', 'CourseController@destroy')->name('course.destroy');
});


Route::group(['prefix' => 'tutor'], function() {
    Route::get('create', 'TutorController@create')->name('tutor.create')->middleware('auth');
    Route::get('/', 'TutorController@index')->name('tutor.index')->middleware('auth');
    Route::post('store', 'TutorController@store')->name('tutor.store')->middleware('auth');
    Route::get('edit/{id}', 'TutorController@edit')->name('tutor.edit')->middleware('auth');
    Route::get('detail/{id}', 'TutorController@detail')->name('tutor.detail')->middleware('auth');
    Route::post('update', 'TutorController@update')->name('tutor.update')->middleware('auth');
    Route::post('/search-tutor', 'TutorController@searchTutorBySurname')->name('tutor.search-tutor');
    Route::post('/search-dad', 'TutorController@searchDadBySurname')->name('tutor.search-dad');
    Route::post('/search-mom', 'TutorController@searchMomBySurname')->name('tutor.search-mom');
    Route::post('/status','TutorController@status')->name('tutor.status');
    Route::get('/destroystudent/{tutor_id}/{student_id}', 'TutorController@destroystudent')->name('tutor.destroystudent')->middleware('auth');
    Route::get('/destroy/{id}', 'TutorController@destroy')->name('tutor.destroy')->middleware('auth');
});

Route::group(['prefix' => 'grade'], function() {
    Route::get('crear', 'GradeController@create')->name('grade.create')->middleware('auth');
    Route::get('/', 'GradeController@index')->name('grade.index');
    Route::post('store', 'GradeController@store')->name('grade.store');
    Route::get('edit/{id}', 'GradeController@edit')->name('grade.edit');
    Route::get('detail/{id}', 'GradeController@detail')->name('grade.detail');
    Route::post('update', 'GradeController@update')->name('grade.update');
    Route::get('delete/{id}', 'GradeController@destroy')->name('grade.destroy');
    Route::post('/status','GradeController@status')->name('grade.status');
    Route::get('/icon/{id}', 'GradeController@getImage')->name('grade.icon');
});

Route::group(['prefix' => 'school'], function() {
    Route::get('create', 'SchoolController@create')->name('school.create')->middleware('auth');
    Route::get('/', 'SchoolController@index')->name('school.index');
    Route::post('store', 'SchoolController@store')->name('school.store');
    Route::get('detail/{id}', 'SchoolController@detail')->name('school.detail');
    Route::get('edit/{id}', 'SchoolController@edit')->name('school.edit')->middleware('auth');
    Route::post('update', 'SchoolController@update')->name('school.update');
});

Route::group(['prefix' => 'cycle'], function() {
    Route::get('create', 'CycleController@create')->name('cycle.create')->middleware('auth');
    Route::get('/', 'CycleController@index')->name('cycle.index')->middleware('auth');
    Route::post('store', 'CycleController@store')->name('cycle.store')->middleware('auth');
    Route::get('detail/{id}', 'CycleController@detail')->name('cycle.detail')->middleware('auth');
    Route::get('edit/{id}', 'CycleController@edit')->name('cycle.edit')->middleware('auth');
    Route::post('update', 'CycleController@update')->name('cycle.update')->middleware('auth');
    Route::post('/status','CycleController@status')->name('cycle.status')->middleware('auth');
    Route::get('/destroy/{id}', 'CycleController@destroy')->name('cycle.destroy')->middleware('auth');
    Route::get('createcurrent', 'CycleController@createcurrent')->name('cycle.createcurrent')->middleware('auth');
    Route::post('updatecurrent', 'CycleController@updatecurrent')->name('cycle.updatecurrent')->middleware('auth');
});

Route::group(['prefix' => 'announcement'], function() {
    Route::get('create', 'AnnouncementController@create')->name('announcement.create')->middleware('auth');
    Route::get('/', 'AnnouncementController@index')->name('announcement.index');
    Route::post('store', 'AnnouncementController@store')->name('announcement.store');
    Route::get('detail/{id}', 'AnnouncementController@detail')->name('announcement.detail');
    Route::get('edit/{id}', 'AnnouncementController@edit')->name('announcement.edit')->middleware('auth');
    Route::post('update', 'AnnouncementController@update')->name('announcement.update');
    Route::post('/status', 'AnnouncementController@status')->name('announcement.status');
    Route::get('destroy/{id}','AnnouncementController@destroy')->name('announcement.destroy');
});

Route::group(['prefix' => 'paymentcategory'], function() {
    Route::get('create', 'PaymentcategoryController@create')->name('paymentcategory.create')->middleware('auth');
    Route::get('/', 'PaymentcategoryController@index')->name('paymentcategory.index');
    Route::post('store', 'PaymentcategoryController@store')->name('paymentcategory.store');
    Route::get('detail/{id}', 'PaymentcategoryController@detail')->name('paymentcategory.detail');
    Route::get('edit/{id}', 'PaymentcategoryController@edit')->name('paymentcategory.edit')->middleware('auth');
    Route::post('update', 'PaymentcategoryController@update')->name('paymentcategory.update');
    Route::post('/status','PaymentcategoryController@status')->name('paymentcategory.status');
    Route::get('destroy/{id}', 'PaymentcategoryController@destroy')->name('paymentcategory.destroy');
});

Route::group(['prefix' => 'employee'], function() {
    Route::get('create', 'EmployeeController@create')->name('employee.create')->middleware('auth');
    Route::get('/', 'EmployeeController@index')->name('employee.index');
    Route::post('store', 'EmployeeController@store')->name('employee.store');
    Route::get('detail/{id}', 'EmployeeController@detail')->name('employee.detail');
    Route::get('edit/{id}', 'EmployeeController@edit')->name('employee.edit')->middleware('auth');
    Route::post('update', 'EmployeeController@update')->name('employee.update');
    Route::post('/status','EmployeeController@status')->name('employee.status');
    Route::get('destroy/{id}', 'EmployeeController@destroy')->name('employee.destroy');
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

Route::group(['prefix' => 'pensum'], function() {
    Route::get('create', 'PensumController@create')->name('pensum.create')->middleware('auth');
    Route::get('/detail/{grade_id}', 'PensumController@detail')->name('pensum.detail')->middleware('auth');
    Route::get('/menu', 'PensumController@menu')->name('pensum.menu')->middleware('auth');
    Route::get('edit/{grade_id}', 'PensumController@edit')->name('pensum.edit')->middleware('auth');
    Route::post('update', 'PensumController@update')->name('pensum.update')->middleware('auth');
});

Route::group(['prefix' => 'subjectstudent'], function() {
    Route::get('create/{student_id?}', 'SubjectstudentController@create')->name('subjectstudent.create')->middleware('auth');
    Route::get('edit/{student_id}/{cycle_id}/{grade_id}', 'SubjectstudentController@edit')->name('subjectstudent.edit')->middleware('auth');
    Route::get('inscription/{student_id}', 'SubjectstudentController@inscription')->name('subjectstudent.inscription');
    Route::get('/', 'SubjectstudentController@index')->name('subjectstudent.index');
    Route::get('/reportcard/{cycle_id?}/{student_id?}', 'SubjectstudentController@reportcard')->name('subjectstudent.reportcard');//eliminar
    Route::post('update', 'SubjectstudentController@update')->name('subjectstudent.update');
    Route::post('store', 'SubjectstudentController@store')->name('subjectstudent.store');
    Route::get('detail/{student_id}/{cycle_id}/{grade_id}', 'SubjectstudentController@detail')->name('subjectstudent.detail');
    Route::post('/status','SubjectstudentController@status')->name('subjectstudent.status');
    Route::get('destroycourse/{student_id}/{cycle_id}/{grade_id}/{coursegrade_id}', 'SubjectstudentController@destroycourse')->name('subjectstudent.destroycourse');
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
    Route::get('activity/{coursegrade_id?}/{unit_id?}', 'ActivityController@courseprofessoractivity')->name('courseprofessor.activity')->middleware('checkcoursegradeprofessor');
});

Route::group(['prefix' => 'activity'], function() {
    Route::get('create/{employee_id?}/{coursegrade_id?}', 'ActivityController@create')->name('activity.create')->middleware('auth');
    Route::post('store', 'ActivityController@store')->name('activity.store')->middleware('auth');
    Route::get('detail/{id}', 'ActivityController@detail')->name('activity.detail');
    Route::get('edit/{id}', 'ActivityController@edit')->name('activity.edit')->middleware('auth');
    Route::post('update', 'ActivityController@update')->name('activity.update')->middleware('auth');
    Route::get('/destroy/{id}', 'ActivityController@destroy')->name('activity.destroy')->middleware('auth');
});

Route::group(['prefix' => 'payment'], function() {
    Route::get('create', 'PaymentController@create')->name('payment.create')->middleware('auth','admin');
    Route::get('/', 'PaymentController@index')->name('payment.index')->middleware('auth','admin');
    Route::get('detail/{id}', 'PaymentController@detail')->name('payment.detail')->middleware('auth','admin');
    Route::get('edit/{id}', 'PaymentController@edit')->name('payment.edit')->middleware('auth','admin');
    Route::post('store', 'PaymentController@store')->name('payment.store')->middleware('auth','admin');
    Route::post('update', 'PaymentController@update')->name('payment.update')->middleware('auth','admin');
    Route::get('menureport','PaymentController@menureport')->name('payment.menureport')->middleware('auth','admin');
    Route::get('/destroy/{id}', 'PaymentController@destroy')->name('payment.destroy')->middleware('auth','admin');
    Route::post('/exist', 'PaymentController@exist')->name('payment.exist')->middleware('auth','admin');
    Route::post('/existreceipt', 'PaymentController@existreceipt')->middleware('auth','admin');

});

Route::name('reportcardpdf')->get('/reportcardpdf/{cycle_id}/{student_id}','SubjectstudentController@reportcardPDF')->middleware('auth');
Route::name('reportpaymentallpdf')->post('/reportpaymentallpdf','PaymentController@reportpaymentallpdf')->middleware('auth','admin');
Route::name('reportpaymentxcategorypdf')->post('/reportpaymentxcategorypdf','PaymentController@reportpaymentxcategorypdf')->middleware('auth','admin');
Route::name('reportpaymentstudentpdf')->post('/reportpaymentstudentpdf','PaymentController@reportpaymentstudentpdf')->middleware('auth','admin');
