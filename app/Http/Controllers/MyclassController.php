<?php

namespace App\Http\Controllers;
use App\ClassDetail;
use App\MyClass as MyClass;
use App\User;
use App\Course;
use App\Grade;
use App\Http\Resources\ClassResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class MyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($school_id)
     {
       return ($school_id > 0)? ClassResource::collection(MyClass::bySchool($school_id)->get()):response()->json([
         'Invalid School id: '. $school_id,
         404
       ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $request->validate([
      //   echo $request;
      // ]);
      // $tb = new MyClass;
      // $tb->class_number = $request->class_number;
      // $tb->school_id = \Auth::user()->school_id;
      // $tb->group = (!empty($request->group))?$request->group:'';
      // $tb->save();
      return redirect('home')->with('status', __('Courses Confirmed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function studentStore(Request $request)
    {
      $reqs = $request->all();
      if ($reqs != null){

        $term = '';
        foreach ($reqs as $k => $v) {
          if ($k == 'term'){
            $term = $v;
            break;
          }
        }

        // store the data into MyClass
        $tb_class = new MyClass;
        $tb_class->user_id = \Auth::user()->id;
        $tb_class->term = $term;
        $tb_class->save();
        
        // store the data into ClassDetail
        foreach ($reqs as $k => $current_course_id) {
          if ($k != '_token' && $k != 'term'){
            $tb_classdetail = new ClassDetail;
            $tb_classdetail->user_id = \Auth::user()->id;
            $tb_classdetail->class_id = $tb_class->id;
            $tb_classdetail->course_id = $current_course_id;
            $tb_classdetail->term = $term;       
            $tb_classdetail->save();
          }
        }

        // set a flag that once students confirm courses selection, they cannot select again.
        $tb_user = User::find(\Auth::user()->id);
        $tb_user->course_token = 0;
        $tb_user->save();

      }
      return redirect('home')->with('status', __('Courses Confirmed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClassResource(MyClass::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tb = MyClass::find($id);
      $tb->class_number = $request->class_number;
      $tb->school_id = $request->school_id;
      return ($tb->save())?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }

    /**
     * Show selected courses of the current student on their own.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentCourses(){
      // $myClasses = MyClass::with('user', 'classdetails')
      //                     ->where('user_id', \Auth::user()->id)
      //                     ->get();
      $user = User::with('major', 'qualification', 'programme', 'myClasses')
                  ->find(\Auth::user()->id);
      $classdetails = ClassDetail::with('myClass', 'course')
                       ->where('user_id', \Auth::user()->id)
                       ->orderBy('course_id', 'asc')
                       ->get();
      
      $totalCredits = 0;
      if ($classdetails != null){
        foreach ($classdetails as $k => $v) {
          $totalCredits += $v->approved_credit;
        }
      }

      return view('mycourses.student-mycourses',compact('classdetails', 'user', 'totalCredits'));
    }

    /**
     * Show selected courses of the current teacher on their own.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherCourses(){
      $myclasses = Course::where('teacher_id', \Auth::user()->id)
                         ->whereNotIn('current_offered', ['Not offered', 'No longer offered', 'TBA'])
                         ->distinct()
                         ->get(['code', 'name', 'credit']);

      $mystudents = Course::where('teacher_id', \Auth::user()->id)
                          ->whereNotIn('current_offered', ['Not offered', 'No longer offered', 'TBA'])
                          ->with(['classdetails' => function($query){
                              $query->where('active', 1);
                              $query->with(['user' => function ($query) {
                                    $query->get();
                              }]);
                            }])
                            ->get();
                         
                            // with(['author' => function ($query) {
                            //   $query->select(['specified column']);
                            //   $query->with(['contacts' => function ($query) {
                            //       $query->select(['specified column']);
                            //   }]);
 
      //dd($mystudents);                  
      $user = User::with('programme')->find(\Auth::user()->id);
      $grades = Grade::get();
 
      return view('mycourses.teacher-mycourses',compact('myclasses', 'user', 'grades', 'mystudents'));
    }
    
    public function teacherGrade(Request $request) {
      if (\Auth::user()->role == 'teacher' || \Auth::user()->role == 'admin'){
        $current_classdetail = ClassDetail::find($request->classdetail_id);
        if ($current_classdetail->active == 1){
          $current_classdetail->approved_credit = $request->approved_credit;
          $current_classdetail->grade_id = $request->grade_id;
          $current_classdetail->save();
          return response()->json(['success' => true]);
        }else{
          return response()->json(['success' => false]);
        }
      }
    }

    /**
     * Show selected courses of a specified student by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentSelections($id){
      // $myClasses = MyClass::with('user', 'classdetails')
      //                     ->where('user_id', \Auth::user()->id)
      //                     ->get();
      $user = User::with('major', 'qualification', 'programme', 'myClasses')
                  ->find($id);
      $classdetails = ClassDetail::with('myClass', 'course', 'grade')
                       ->where('user_id', $id)
                       ->orderBy('course_id', 'asc')
                       ->get();
      
      $totalCredits = 0;
      if ($classdetails != null){
        foreach ($classdetails as $k => $v) {
          $totalCredits += $v->approved_credit;
        }
      }

      return view('mycourses.student-mycourses',compact('classdetails', 'user', 'totalCredits'));
    }

    /**
     * Show courses list of a specified teacher by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function teacherSelections($id){
      $myclasses = Course::where('teacher_id', $id)
                         ->whereNotIn('current_offered', ['Not offered', 'No longer offered', 'TBA'])
                         ->distinct()
                         ->get(['code', 'name', 'credit']);

      $mystudents = Course::where('teacher_id', $id)
                          ->whereNotIn('current_offered', ['Not offered', 'No longer offered', 'TBA'])
                          ->with(['classdetails' => function($query){
                              $query->where('active', 1);
                              $query->with(['user' => function ($query) {
                                    $query->get();
                              }]);
                            }])
                            ->get();

      $user = User::with('programme')->find($id);
      $grades = Grade::get();
 
      return view('mycourses.teacher-mycourses',compact('myclasses', 'user', 'grades', 'mystudents'));
    }


     /**
     * Show selected courses of a specified teacher by admin.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * delete the latest record from myclass and classdetails tables
     * reset course_token for a specified student .
     *
     * @return \Illuminate\Http\Response
     */
    public function studentReselect($id){
      $tb_user = User::with('school')->find($id);
      $current_class = MyClass::where('user_id', $id)->where('active', 1)->get()->last();
      if ($tb_user->course_token == 0 && 
          $tb_user->school->toggle == 1 && 
          $tb_user->active == 1 && 
          $current_class != null) {
        $current_class->delete();
        $tb_user->course_token = 1;
        $tb_user->save();
      }
      return back()->with('status', __('Done!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (MyClass::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}