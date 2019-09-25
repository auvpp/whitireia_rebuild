<?php
namespace App\Services\User;

use App\User;
use App\StudentInfo;
use Illuminate\Support\Facades\DB;
use Mavinoo\LaravelBatch\Batch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserService {
    
    protected $user;
    protected $db;
    protected $batch;
    protected $st, $st2;
    protected $faker;

    public function __construct(User $user, DB $db, Batch $batch, Faker $faker){
        $this->user = $user;
        $this->db = $db;
        $this->batch = $batch;
        $this->faker = $faker;
    }

    public function isListOfStudents($school_code, $student_code){
        return !empty($school_code) && $student_code == 1;
    }

    public function isListOfTeachers($school_code, $teacher_code){
        return !empty($school_code) && $teacher_code == 1;
    }

    public function indexView($view, $users){
        return view($view, [
            'users' => $users,
            // 'current_page' => $users->currentPage(),
            // 'per_page' => $users->perPage(),
        ]);
    }

    public function hasSectionId($section_id){
        return $section_id > 0;
    }

    public function updateStudentInfo($request, $id){
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
        $info->session = (!empty($request->session)) ? $request->session : '';
        $info->version = (!empty($request->version)) ? $request->version : '';
        $info->group = (!empty($request->group)) ? $request->group : '';
        $info->birthday = (!empty($request->birthday)) ? $request->birthday : '';
        $info->religion = (!empty($request->religion)) ? $request->religion : '';
        $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
        $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
        $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
        $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
        $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
        $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
        $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
        $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
        $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
        $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
        $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
        $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
        $info->user_id = auth()->user()->id;
        $info->save();
    }

    public function promoteSectionStudentsView($students, $classes, $section_id){
        return view('school.promote-students', compact('students','classes','section_id'));
    }
    
    public function promoteSectionStudentsPost($request)
    {   
        if ($request->section_id > 0) {
            $students = $this->getSectionStudentsWithStudentInfo($request, $request->section_id);
            $i = 0;
            foreach ($students as $student) {
                $this->st[] = [
                    'id' => $student->student_id,
                    'section_id' => $request->to_section[$i],
                    'active' => isset($request["left_school$i"])?0:1,
                ];

                $this->st2[] = [
                    'student_id' => $student->student_id,
                    'session' => $request->to_session[$i],
                ];
                ++$i;
            }
            $this->promoteSectionStudentsPostDBTransaction();
            
            return back()->with('status', 'Saved');
        }
    }

    public function promoteSectionStudentsPostDBTransaction(){
        return $this->db::transaction(function () {
            $table1 = 'users';
            $this->batch->update($table1, (array) $this->st, 'id');
            $table2 = 'student_infos';
            $this->batch->update($table2, (array) $this->st2, 'student_id');
        });
    }

    public function isAccountant($role){
        return $role == 'accountant';
    }

    public function isLibrarian($role){
        return $role == 'librarian';
    }

    public function indexOtherView($view, $users){
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function getStudents($school_id){
        return $this->user->with(['school', 'programme', 'major', 'myClasses', 'qualification'])
                //->where('code', auth()->user()->school->code)
                //->student()
                ->where('active', 1)
                ->where('school_id', $school_id)
                ->where('role', 'student')
                ->orderBy('first_name', 'asc')
                ->get();
                //->paginate(10);
    }

    public function getTeachers($school_id){
        return $this->user->with(['school', 'programme'])
                //->where('code', auth()->user()->school->code)
                ->where('school_id', $school_id)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->orderBy('first_name', 'asc')
                ->get();
                //->paginate(10);
    }

    public function getAccountants(){
        return $this->user->with('school')
                ->where('code', auth()->user()->school->code)
                ->where('role', 'accountant')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getLibrarians(){
        return $this->user->with('school')
                ->where('code', auth()->user()->school->code)
                ->where('role', 'librarian')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getSectionStudentsWithSchool($section_id){
        return $this->user->with('school')
            ->student()
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getSectionStudentsWithStudentInfo($request, $section_id){
		$ignoreSessions = $request->session()->get('ignoreSessions');
		
        if (isset($ignoreSessions) && $ignoreSessions == "true") {
			return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                //->where('student_infos.session', '<=', now()->year)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->get();
		} else {
			return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                ->where('student_infos.session', '<=', now()->year)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->get();
		}
    }

    public function getSectionStudents($section_id){
        return $this->user->where('section_id', $section_id)
                ->where('active', 1)
                ->get();
    }

    public function getUserByCode($id){
        if ($id == \Auth::user()->id){
            return $this->user->with('programme', 'major', 'qualification', 'school')
                              ->where('id', $id)
                              ->where('active', 1)
                              ->first();
        }else{
            return 'no permission';
        }
    }

    public function storeAdmin($request){
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = $request->email;
        $tb->password = bcrypt($request->password);
        $tb->role = 'admin';
        $tb->active = 1;
        $tb->school_id = session('register_school_id');
        $tb->code = session('register_school_code');
        $tb->student_code = session('register_school_id').date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        //$tb->blood_group = $request->blood_group;
        //$tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->save();
        return $tb;
    }

    public function storeStudent($request, $role){
        $tb = new $this->user;
        $tb->about = (!empty($request->about)) ? $request->about : '';
        $tb->first_name = ucfirst($request->first_name);
        $tb->last_name = ucfirst($request->last_name);
        //$tb->code = $this->faker->unique()->randomNumber(6, true);
        $tb->code = $request->code;
        $tb->school_id = \Auth::user()->school_id;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt('secret');
        $tb->enrolled_date = date('Y-m-d');
        $tb->role = $role;
        $tb->active = 1;
        $tb->gender = $request->gender;
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address)) ? $request->address : '';
        $tb->programme_id = $request->programme_id;   
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->course_token = 1;
        $tb->remember_token = str_random(10);
        $tb->qualification_id = $request->qualification_id;
        $tb->major_id = $request->major_id;
        //dd($tb);
        // $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->save();
        return $tb;
    }

    public function storeTeacher($request, $role){

        $tb = new $this->user;
        $tb->about = (!empty($request->about)) ? $request->about : '';
        $tb->first_name = ucfirst($request->first_name);
        $tb->last_name = ucfirst($request->last_name);
        $tb->code = $this->faker->unique()->randomNumber(6, true);
        $tb->school_id = \Auth::user()->school_id;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt('secret');
        $tb->enrolled_date = date('Y-m-d');
        $tb->role = $role;
        $tb->active = 1;
        $tb->gender = $request->gender;
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address)) ? $request->address : '';
        $tb->programme_id = $request->programme_id;   
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->course_token = 1;
        $tb->remember_token = str_random(10);
        //dd($tb);
        // $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->save();
        return $tb;
    }
}