<?php

namespace App\Http\Controllers;
use Illuminate\Support;

use App\Course;
use App\Major;
use App\User;
use App\MyClass;
use App\Programme;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Requests\Course\SaveConfigurationRequest;
use App\Http\Traits\GradeTrait;
use App\Qualification;
use App\Services\Course\CourseService;

class CourseController extends Controller
{
    use GradeTrait;
    protected $courseService;
    protected $qualification;
    protected $majors;
    protected $courses;
    protected $teacher;

    public function __construct(CourseService $courseService, Qualification $qualification){
      $this->courseService = $courseService;
      $this->qualification = $qualification;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id, $section_id){
      if($this->courseService->isCourseOfTeacher($teacher_id)) {
        $courses = $this->courseService->getCoursesByTeacher($teacher_id);
        $exams = $this->courseService->getExamsBySchoolId();
        $view = 'course.teacher-course';

      } else if($this->courseService->isCourseOfStudentOfASection($section_id)) {
        $courses = $this->courseService->getCoursesBySection($section_id);
        $view = 'course.class-course';
        $exams = [];

      } else if($this->courseService->isCourseOfASection($section_id)) {
        $courses = $this->courseService->getCoursesBySection($section_id);
        $exams = $this->courseService->getExamsBySchoolId();
        $view = 'course.class-course';
      } else {
        return redirect('home');
      }
      return view($view,compact('courses','exams'));
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
     * Show courses by qualification_id
     *
     * @return \Illuminate\Http\Response
     */
    public function course($id)
    {
      $qualification = $this->qualification->find($id);
      $majors = Major::with(['users', 'courses', 'qualification',])
                    ->where('qualification_id', $id)
                    ->orderBy('name', 'asc')
                    ->get();
      
      $programme_id = $qualification->programme_id;
      
      $teachers = User::with('programme')
                    ->where('role', 'teacher')
                    ->orderBy('first_name', 'asc')
                    ->get();

      // $teachers = User::with('programme')
      // ->where('programme_id', $programme_id)
      // ->where('role', 'teacher')
      // ->get();

      //$courses = $this->courseService->getCoursesByMajors();
      return view('course.admin-course', compact('qualification', 'majors', 'teachers'));
    }

    public function selectionList(){
      $user = User::with('major', 'qualification', 'programme')->find(\Auth::user()->id);
      $myClasses = MyClass::with('classDetails')->where('user_id', $user->id)->get();
      $courses = Course::where('major_id', $user->major_id)
                    ->orderBy('code', 'asc')
                    ->get();
      return view('course.students', compact('courses', 'user', 'myClasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $this->courseService->addCourse($request);
      } catch (\Exception $ex){
        return __('Could not add course.');
      }
      return back()->with('status', __('Created'));
    }

    /**
     * @param SaveConfigurationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConfiguration(SaveConfigurationRequest $request){
      try{
        $this->courseService->saveConfiguration($request);
      } catch (\Exception $ex){
        return __('Could not save configuration.');
      }
      return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return new CourseResource(Course::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $course = Course::find($id);
      return view('course.edit', ['course'=>$course]);
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
      $request->validate([
        'code' => 'required|string',
        'name' => 'required|string',
        'level' => 'required|string',
        'type'  => 'required|string',
        'credit' => 'required|integer',
        'prerequisite' =>'string',
        'current_offered' => 'required|string',
        'next_offered' => 'required|string',
        'teacher' => 'required|string',
        'description' => 'nullable|string',
      ]);
      $this->courseService->updateCourseInfo($id, $request);
      return back()->with('status', __('Course Saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Course::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
