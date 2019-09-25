<?php

use Illuminate\Support\Facades\Auth;
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

/* welcome page for all users */
Route::get('/', function () {
  return view('welcome');
});

/* authentication route by lavavel default */
Auth::routes();
/* one line of statement above equals to the following statements below */
// // the Route for user authentication
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // the Route for user registration
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// // the Route for resetting password
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// // the Route for email authentication
// Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
// Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
// Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/* the Route for home page */
Route::get('/home', 'HomeController@index')->name('home');

/* the Route for master */
Route::middleware(['auth', 'master'])->group(function () {
    Route::get('/masters', 'MasterController@index')->name('masters.index');
    Route::resource('/schools', 'SchoolController')->only(['index', 'edit', 'store', 'update']);

    Route::get('register/admin/{id}/{code}', function($id, $code){
      session([
        'register_role' => 'admin',
        'register_school_id' => $id,
        'register_school_code' => $code,
        ]);
      return redirect()->route('register');
    });
    
    Route::post('register/admin', 'UserController@storeAdmin');
    Route::get('master/activate-admin/{id}','UserController@activateAdmin');
    Route::get('master/deactivate-admin/{id}','UserController@deactivateAdmin');

    Route::get('school/admin-list/{school_id}','SchoolController@showAdmins');

    // manage administrators
    Route::post('school/admin-list/store','SchoolController@storeAdminProfile');

    // the Route for resetting password
    Route::post('admin/password/reset', 'SchoolController@resetAdmin');
});

//Route::get('users/{school_id}/students', 'UserController@indexStudent')->middleware(['auth', 'teacher']);


/* the Route for all users */
Route::middleware(['auth'])->group(function (){
  if (config('app.env') != 'production') {
    Route::get('user/config/impersonate', 'UserController@impersonateGet');
    Route::post('user/config/impersonate', 'UserController@impersonate');
  }

  // Route::get('users/{school_id}/{student_code}/{teacher_code}', 'UserController@index');
  Route::get('users/{school_id}/teachers', 'UserController@indexTeacher');
  Route::get('users/{school_id}/students', 'UserController@indexStudent');

  //Route::get('users/{school_code}/{role}', 'UserController@indexOther');
  Route::get('user/{id}', 'UserController@show'); // show user's profile
  Route::get('user/config/change_password', 'UserController@changePasswordGet');
  Route::post('user/config/change_password', 'UserController@changePasswordPost');
  Route::get('section/students/{section_id}', 'UserController@sectionStudents');
  
  Route::get('courses/{teacher_id}/{section_id}', 'CourseController@index');

  //Route::get('edit/user/{id}','UserController@edit');  // edit user
  Route::post('edit/user','UserController@update'); // update a user
});

/* the Route for administrators */
Route::middleware(['auth','admin'])->group(function (){

  Route::prefix('school')->name('school.')->group(function (){
    Route::post('add-class','MyClassController@store');
    Route::post('add-section','SectionController@store');
    Route::post('add-department','SchoolController@addDepartment');
    Route::get('promote-students/{section_id}','UserController@promoteSectionStudents');
    Route::post('promote-students','UserController@promoteSectionStudentsPost');
    Route::post('theme','SchoolController@changeTheme');
	Route::post('set-ignore-sessions','SchoolController@setIgnoreSessions');
  });

  Route::prefix('register')->name('register.')->group(function (){
    Route::get('student', 'UserController@redirectToRegisterStudent');
    Route::get('teacher', function(){
      $departments = \App\Department::where('school_id',\Auth::user()->school_id)->get();
      $classes = \App\MyClass::where('school_id',\Auth::user()->school->id)->pluck('id');
      $sections = \App\Section::with('class')->whereIn('class_id',$classes)->get();
      session([
        'register_role' => 'teacher',
        'departments' => $departments,
        'register_sections' => $sections
      ]);
      return redirect()->route('register');
    });
  });
  
  /* the Route for clicking "programmes"，which needs to be optimized later */
  Route::get('/programmes/business', 'ProgrammeController@showBusiness')->name('programme.business');
  Route::get('/programmes/it', 'ProgrammeController@ShowIT')->name('programme.it');

  /* show all courses */
  Route::get('/programmes/business/{id}', 'CourseController@course');
  Route::get('/programmes/it/{id}', 'CourseController@course');

  // edit courses
  //Route::get('edit/course/{id}','CourseController@edit');
  Route::post('edit/course/{id}','CourseController@update');

  // add a new course
  Route::post('add/course','CourseController@store');

  // show the selection list of a student or a teacher
  Route::get('selectionlist/student/{id}', 'MyClassController@studentSelections');
  Route::get('selectionlist/teacher/{id}', 'MyClassController@teacherSelections');
  
  // reselect courses
  Route::get('reselect/student/{id}', 'MyClassController@studentReselect');

  // settings page
  Route::get('/settings', 'SettingController@index')->name('settings.index');
  Route::post('/settings', 'SettingController@toggle');
  Route::post('/settings/checkcode', 'CourseController@checkCode');
  Route::post('/settings/addcourse', 'CourseController@store');
  Route::post('/settings/addteacher', 'UserController@storeTeacher');
  Route::post('/settings/addstudent', 'UserController@storeStudent');

  // the Route for resetting password
  Route::post('user/password/reset', 'UserController@resetUser');
  // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

  Route::get('gpa/create-gpa', 'GradesystemController@create');
  Route::post('create-gpa', 'GradesystemController@store');
  Route::post('gpa/delete', 'GradesystemController@destroy');
});

/* the Route for teachers */
Route::middleware(['auth','teacher'])->group(function (){
  Route::post('calculate-marks','GradeController@calculateMarks');
  Route::post('message/students', 'NotificationController@store');

  Route::get('exams/active', 'ExamController@indexActive');
  Route::get('school/sections','SectionController@index');

  Route::get('gpa/all-gpa', 'GradesystemController@index');

  /* the Route for clicking "programmes"，which needs to be optimized later */
  Route::get('/programmes/business', 'ProgrammeController@showBusiness')->name('programme.business');
  Route::get('/programmes/it', 'ProgrammeController@ShowIT')->name('programme.it');

  /* show all courses */
  Route::get('/programmes/business/{id}', 'CourseController@course');
  Route::get('/programmes/it/{id}', 'CourseController@course');

  Route::get('tcourses', 'MyClassController@teacherCourses')->name('mycourses.teacher-mycourses');
  Route::post('tcourses', 'MyClassController@teacherGrade');
});

Route::middleware(['auth','teacher'])->prefix('grades')->group(function (){
  Route::get('all-exams-grade', 'GradeController@allExamsGrade');
  Route::get('section/{section_id}', 'GradeController@gradesOfSection');
  Route::get('t/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@tindex')->name('teacher-grade');
  Route::get('c/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@cindex');
  Route::post('calculate-marks','GradeController@calculateMarks');
  Route::post('save-grade','GradeController@update');

  Route::get('course/students/{teacher_id}/{course_id}/{exam_id}/{section_id}','CourseController@course');
  Route::post('courses/create', 'CourseController@create');
  // Route::post('courses/save-under-exam', 'CourseController@update');
  Route::post('courses/store', 'CourseController@store');
  Route::post('courses/save-configuration', 'CourseController@saveConfiguration');
});

/* the Route for students */
Route::middleware(['auth', 'student'])->prefix('stripe')->group(function(){
  Route::get('charge', 'CashierController@index');
  Route::post('charge','CashierController@store');
  Route::get('receipts', 'PaymentController@index');
});

Route::middleware(['auth', 'student'])->group(function(){
  Route::get('courses/selection', 'CourseController@selectionList');
  Route::post('courses/selection', 'MyClassController@studentStore');

  /* show seletec courses of a student*/
  Route::get('mycourses', 'MyClassController@studentCourses');
  
  //Route::post('courses','CourseController@index');
});

/* the Route for attendances */
// Route::middleware(['auth'])->group(function (){
//   Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
//   // Route::get('/view-attendance/section/{section_id}',function($section_id){
//   //   if($section_id > 0){
//   //     $attendances = App\Attendance::with(['student'])->where('section_id', $section_id)->get();
//   //   }
//   // });
//   Route::get('attendances/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'AttendanceController@addStudentsToCourseBeforeAtt')->middleware(['teacher']);
//   Route::get('attendances/{section_id/{student_id}/{exam_id}', 'AttendanceController@index');
//   Route::get('attendances/{section_id}', 'AttendanceController@sectionIndex')->middleware(['teacher']);
//   Route::post('attendance/take-attendance','AttendanceController@store')->middleware(['teacher']);
//   Route::get('attendance/adjust/{student_id}','AttendanceController@adjust')->middleware(['teacher']);
//   Route::post('attendance/adjust','AttendanceController@adjustPost')->middleware(['teacher']);
// });

Route::get('grades/{student_id}', 'GradeController@index')->middleware(['auth','teacher.student']);

Route::get('user/{id}/notifications', 'NotificationController@index')->middleware(['auth','student']);

/* the Route for syllabus / notice / event / routine */
// Route::middleware(['auth','admin'])->prefix('academic')->name('academic.')->group(function (){
//   Route::get('syllabus', 'SyllabusController@index');
//   Route::get('syllabus/{class_id}', 'SyllabusController@create');
//   Route::get('notice', 'NoticeController@create');
//   Route::get('event', 'EventController@create');
//   Route::get('routine', 'RoutineController@index');
//   Route::get('routine/{section_id}', 'RoutineController@create');
//   Route::prefix('remove')->name('remove.')->group(function (){
//     Route::get('syllabus/{id}', 'SyllabusController@update');
//     Route::get('notice/{id}', 'NoticeController@update');
//     Route::get('event/{id}', 'EventController@update');
//     Route::get('routine/{id}', 'RoutineController@update');
//   });
// });

/* the Route for exams administration */
// Route::middleware(['auth','admin'])->prefix('exams')->name('exams.')->group(function (){
//   Route::get('/', 'ExamController@index');
//   Route::get('create', 'ExamController@create');
//   Route::post('create', 'ExamController@store');
//   Route::post('activate-exam', 'ExamController@update');
// });

/* the Route for librarian */
Route::middleware(['auth', 'librarian'])->namespace('Library')->group(function () {
    Route::prefix('library')->name('library.')->group(function () {
        Route::resource('books', 'BookController');
    });
});

// Route::middleware(['auth','librarian'])->prefix('library')->name('library.issued-books.')->group(function () {
//   Route::get('issue-books', 'IssuedbookController@create')->name('create');
//   Route::post('issue-books', 'IssuedbookController@store')->name('store');
//   Route::get('issued-books', 'IssuedbookController@index')->name('index');
//   Route::post('save_as_returned', 'IssuedbookController@update');
// });

/* the Route for accountant */
// Route::middleware(['auth','accountant'])->prefix('accounts')->name('accounts.')->group(function (){
//   Route::get('sectors','AccountController@sectors');
//   Route::post('create-sector','AccountController@storeSector');
//   Route::get('edit-sector/{id}','AccountController@editSector');
//   Route::post('update-sector','AccountController@updateSector');
//   //Route::get('delete-sector/{id}','AccountController@deleteSector');

//   Route::get('income','AccountController@income');
//   Route::post('create-income','AccountController@storeIncome');
//   Route::get('income-list','AccountController@listIncome');
//   Route::post('list-income','AccountController@postIncome');
//   Route::get('edit-income/{id}','AccountController@editIncome');
//   Route::post('update-income','AccountController@updateIncome');
//   Route::get('delete-income/{id}','AccountController@deleteIncome');
  
//   Route::get('expense','AccountController@expense');
//   Route::post('create-expense','AccountController@storeExpense');
//   Route::get('expense-list','AccountController@listExpense');
//   Route::post('list-expense','AccountController@postExpense');
//   Route::get('edit-expense/{id}','AccountController@editExpense');
//   Route::post('update-expense','AccountController@updateExpense');
//   Route::get('delete-expense/{id}','AccountController@deleteExpense');
// });

// Route::middleware(['auth','accountant'])->prefix('fees')->name('fees.')->group(function (){
//   Route::get('all', 'FeeController@index');
//   Route::get('create', 'FeeController@create');
//   Route::post('create', 'FeeController@store');
// });

//use PDF;
Route::middleware(['auth','master.admin'])->group(function (){

  Route::post('upload/file', 'UploadController@upload');
  Route::post('users/import/user-xlsx','UploadController@import');
  Route::get('users/export/students-xlsx', 'UploadController@export');
//   Route::get('pdf/profile/{user_id}',function($user_id){
//     $data = App\User::find($user_id);
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.profile-pdf', ['user' => $data]);
// 		return $pdf->stream('profile.pdf');
//   });
//   Route::get('pdf/result/{user_id}/{exam_id}',function($user_id, $exam_id){
//     $data = App\User::find($user_id);
//     $grades = App\Grade::with('exam')->where('student_id', $user_id)->where('exam_id',$exam_id)->latest()->get();
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.result-pdf', ['grades' => $grades, 'user'=>$data]);
// 		return $pdf->stream('result.pdf');
//   });
});

// Route::middleware(['auth'])->group(function (){
//   Route::get('download/pdf', function(){
//     $pathToFile = public_path('storage/Bano-EducationandAspiration.pdf');
//     return response()->download($pathToFile);
//   });
// });

// View Emails - in browser
Route::prefix('emails')->group(function () {
  // Welcome Email
  Route::get('/welcome', function () {
      $user = App\User::find(1);
      $password = "secret";
      return new App\Mail\SendWelcomeEmailToUser($user, $password);
  });
});