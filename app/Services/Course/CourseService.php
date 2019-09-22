<?php
namespace App\Services\Course;

use App\User;
use App\Course;
use App\Grade;
use App\Exam;
use Illuminate\Support\Facades\Auth;

class CourseService {

    public function isCourseOfTeacher($teacher_id){
        return auth()->user()->role != 'student' && $teacher_id > 0;
    }

    public function isCourseOfStudentOfASection($section_id){
        return auth()->user()->role == 'student'
                && $section_id == auth()->user()->section_id
                && $section_id > 0;
    }

    public function isCourseOfASection($section_id){
        return auth()->user()->role != 'student' && $section_id > 0;
    }

    public function getCoursesByTeacher($teacher_id){
        return Course::with(['section', 'teacher','exam'])
                        ->where('teacher_id', $teacher_id)
                        ->get();
    }

    public function getExamsBySchoolId(){
        return Exam::where('school_id', auth()->user()->school_id)
                        ->where('active',1)
                        ->get();
    }

    public function updateCourseInfo($id, $request){
        $tb = Course::find($id);
        $tb->code = $request->code;
        $tb->name = $request->name;
        $tb->level = $request->level;
        $tb->type = $request->type;
        $tb->credit = $request->credit;
        $tb->prerequisite = $request->prerequisite;
        $tb->current_offered = $request->current_offered;
        $tb->next_offered = $request->next_offered;
        $tb->teacher_id = $request->teacher_id;
        $tb->teacher = $request->teacher;
        $tb->description = $request->description;
        $tb->save();

        // Simultaneously update all courses with the same code except course type, credits, prerequisite, descriptions
        Course::where('code', $request->code)
              ->update(['teacher' => $request->teacher,
                        'teacher_id' => $request->teacher_id,
                        'name'    => $request->name,
                        'level'   => $request->level,
                        'current_offered' => $request->current_offered,
                        'next_offered' => $request->next_offered
                        ]);
    }

    public function getCoursesBySection($section_id){
        return Course::with(['section', 'teacher'])
                        ->where('section_id', $section_id)
                        ->get();
    }

    public function getStudentsFromGradeByCourseAndExam($course_id, $exam_id){
      return Grade::with('student')
                  ->where('course_id', $course_id)
                  ->where('exam_id',$exam_id)
                  ->get();
    }

    public function addCourse($request){
        $tb = new Course;
        $tb->code = $request->code;
        $tb->name = $request->name;
        $tb->level = $request->level;
        $tb->type = $request->type;
        $tb->credit = $request->credit;
        if ($request->prerequisite == null){
            $tb->prerequisite = 'None';
        }else{
            $tb->prerequisite = $request->prerequisite;
        }
        $tb->current_offered = $request->current_offered;
        $tb->next_offered = $request->next_offered;
        $tb->teacher = $request->teacher;
        $tb->description = $request->description;
        $tb->major_id = $request->major_id;
        $tb->save();
    }

    public function saveConfiguration($request){
        $tb = Course::find($request->id);
        $tb->grade_system_name = $request->grade_system_name;
        $tb->quiz_count = $request->quiz_count;
        $tb->assignment_count = $request->assignment_count;
        $tb->ct_count = $request->ct_count;
        $tb->quiz_percent = $request->quiz_percent;
        $tb->attendance_percent = $request->attendance_percent;
        $tb->assignment_percent = $request->assignment_percent;
        $tb->ct_percent = $request->ct_percent;
        $tb->final_exam_percent = $request->final_exam_percent;
        $tb->practical_percent = $request->practical_percent;
        $tb->att_fullmark = $request->att_fullmark;
        $tb->quiz_fullmark = $request->quiz_fullmark;
        $tb->a_fullmark = $request->a_fullmark;
        $tb->ct_fullmark = $request->ct_fullmark;
        $tb->final_fullmark = $request->final_fullmark;
        $tb->practical_fullmark = $request->practical_fullmark;
        $tb->save();
    }
}