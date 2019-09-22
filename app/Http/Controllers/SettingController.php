<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Qualification;
use App\Programme;
use App\Major;
use App\MyClass;
use App\ClassDetail;
use App\Section;
use App\Department;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        if (\Auth::user()->role == 'admin'){
            // $school      = \Auth::user()->school;
            // $classes     = MyClass::all();
            // $sections    = Section::all();
            // $departments = Department::bySchool(\Auth::user()->school_id)->get();
            $teachers = User::with('programme')
                            ->where('role', 'teacher')
                            ->where('active', 1)
                            ->orderBy('first_name', 'ASC')
                            ->get();

            $majors = Major::query()->get();
            $programmes = Programme::query()->get();
            $qualifications = Qualification::query()->get();
            
            $toggle = \Auth::user()->school->toggle;
            return view('settings.index', compact('toggle', 'teachers', 'majors', 'qualifications', 'programmes'));
        }
        else{
            return redirect('home');
        }
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
                // all students can select courses at this moment
                User::where('role', 'student')->where('active', 1)->update(['course_token' => 1]);
                
                // Deactivated all ClassDetail, that means the new semester begins and
                // all teachers have completed the grades of the previous courses and cannot modify the student's grades.
                ClassDetail::where('active', 1)->update(['active' => 0]);
                
            } 
        }
        return response()->json(['success' => true]);
    }
}
