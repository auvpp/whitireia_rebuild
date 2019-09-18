<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Major;
use App\Qualification;
use App\Programme;
use App\MyClass;
use App\Section;
use App\Department;
use App\Toggle;
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
