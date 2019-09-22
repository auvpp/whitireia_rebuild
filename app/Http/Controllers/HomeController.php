<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minutes = 1440;// 24 hours = 1440 minutes
        $school_id = \Auth::user()->school->id;
        $totalCourses = DB::table('courses')->count();
        $current_user = \App\User::with('myClasses', 'programme', 'qualification', 'major')->find(\Auth::user()->id);


        // $classes = \Cache::remember('classes-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\MyClass::bySchool($school_id)
        //                     ->pluck('id')
        //                     ->toArray();
        // });
        $totalStudents = \Cache::remember('totalStudents-'.$school_id, $minutes, function () use($school_id) {
          return \App\User::bySchool($school_id)
                          ->where('role','student')
                          ->where('active', 1)
                          ->count();
        });
        $totalTeachers = \Cache::remember('totalTeachers-'.$school_id, $minutes, function () use($school_id) {
          return \App\User::bySchool($school_id)
                          ->where('role','teacher')
                          ->where('active', 1)
                          ->count();
        });

        $classdetails = \App\ClassDetail::where('user_id', \Auth::user()->id)
                                   ->orderBy('course_id', 'asc')
                                   ->get();
        $totalCredits = 0;
        if ($classdetails != null){
          foreach ($classdetails as $k => $v) {
            $totalCredits += $v->approved_credit;
          }
        }
        

        // $totalBooks = \Cache::remember('totalBooks-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Book::bySchool($school_id)->count();
        // });
        // $totalClasses = \Cache::remember('totalClasses-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\MyClass::bySchool($school_id)->count();
        // });
        // $totalSections = \Cache::remember('totalSections-'.$school_id, $minutes, function () use ($classes) {
        //   return \App\Section::whereIn('class_id', $classes)->count();
        // });
        // $notices = \Cache::remember('notices-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Notice::bySchool($school_id)
        //                     ->where('active',1)
        //                     ->get();
        // });
        // $events = \Cache::remember('events-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Event::bySchool($school_id)
        //                   ->where('active',1)
        //                   ->get();
        // });
        // $routines = \Cache::remember('routines-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Routine::bySchool($school_id)
        //                     ->where('active',1)
        //                     ->get();
        // });
        // $syllabuses = \Cache::remember('syllabuses-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Syllabus::bySchool($school_id)
        //                       ->where('active',1)
        //                       ->get();
        // });
        // $exams = \Cache::remember('exams-'.$school_id, $minutes, function () use($school_id) {
        //   return \App\Exam::bySchool($school_id)
        //                   ->where('active',1)
        //                   ->get();
        // });
        // if(\Auth::user()->role == 'student')
        //   $messageCount = \App\Notification::where('student_id',\Auth::user()->id)->count();
        // else
        //   $messageCount = 0;
        return view('home',[
          'totalStudents'=>$totalStudents,
          'totalTeachers'=>$totalTeachers,
          'totalCourses'=>$totalCourses,
          'current_user'=>$current_user,
          'totalCredits'=>$totalCredits,
        ]);
    }
}
