<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Qualification;
use App\Programme;
use App\Major;
use App\MyClass;
use App\Section;
use App\Department;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        // $school      = \Auth::user()->school;
        // $classes     = MyClass::all();
        // $sections    = Section::all();
        // $departments = Department::bySchool(\Auth::user()->school_id)->get();
        // $teachers = User::select('departments.*', 'users.*')
		// 	->join('departments', 'departments.id', '=', 'users.department_id')
        //     ->where('role', 'teacher')
        //     ->orderBy('name', 'ASC')
        //     ->where('active', 1)
        //     ->get();
        if (\Auth::user()->role == 'admin'){
            $toggle = \Auth::user()->school->toggle;
        }

        $programmes = Programme::get();
        $qualifications = Qualification::get();
        $majors = Major::get();
        $teachers = User::with('programme')
                        ->where('role', 'teacher')
                        ->orderBy('first_name', 'asc')
                        ->get();
        //dd($programmes);
        // $majors = Major::with(['users', 'courses', 'qualification',])
        //                 ->where('qualification_id', $id)
        //                 ->orderBy('name', 'asc')
        //                 ->get();
        
        // $teachers = User::with('programme')
        //                 ->where('role', 'teacher')
        //                 ->orderBy('first_name', 'asc')
        //                 ->get();

        // $teachers = User::with('programme')
        // ->where('programme_id', $programme_id)
        // ->where('role', 'teacher')
        // ->get();

        //$courses = $this->courseService->getCoursesByMajors();

        return view('settings.index', compact('toggle', 'programmes', 'qualifications', 'majors', 'teachers'));
    }

    public function toggle(Request $request) {
        if (\Auth::user()->role == 'admin'){
            $tb_school = School::find(\Auth::user()->school_id);
            
            if ($request->toggle == 1){   
                $tb_school->toggle = 0;
                $tb_school->save();
                // all students cannot select courses
                User::where('role', 'student')->where('active', 1)->update(['course_token' => 0]);
                // Deactivated all MyClass
                MyClass::where('active', 1)->update(['active' => 0]);
            }
            else{
                $tb_school->toggle = 1;
                $tb_school->save();
                // all students cannot select courses
                User::where('role', 'student')->where('active', 1)->update(['course_token' => 1]);
            } 
        }
        return response()->json(['success' => true]);
    }
}
