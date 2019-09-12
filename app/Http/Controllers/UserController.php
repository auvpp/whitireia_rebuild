<?php

namespace App\Http\Controllers;

use App\Department;
use App\MyClass;
use App\Programme;
use App\Qualification;
use App\Major;
use App\Term;
use App\Section;
use App\StudentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ImpersonateUserRequest;
use App\Http\Requests\User\CreateLibrarianRequest;
use App\Http\Requests\User\CreateAccountantRequest;
use Mavinoo\LaravelBatch\Batch;
use App\Events\UserRegistered;
use App\Events\StudentInfoUpdateRequested;
use Illuminate\Support\Facades\Log;
use App\Services\User\UserService;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $userService;
    protected $user;

    public function __construct(UserService $userService, User $user){
        $this->userService = $userService;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_id, $student_code, $teacher_code){
        // session()->forget('section-attendance');
        
        if($this->userService->isListOfStudents($school_id, $student_code))
            return $this->userService->indexView('list.student-list', $this->userService->getStudents($school_id));
        else if($this->userService->isListOfTeachers($school_id, $teacher_code))
            return $this->userService->indexView('list.teacher-list',$this->userService->getTeachers($school_id));
        else
            return view('home');
    }

    /**
     * Display a list of all teachers based on school_id.
     * @param $school_id
     */
    public function indexTeacher($school_id){
        $majors = Major::query()->get();
        $programmes = Programme::query()->get();
        $qualifications = Qualification::query()->get();
        $users = $this->userService->getTeachers($school_id);
        $current_page = $users->currentPage();
        $per_page = $users->perPage();
        return view('list.teacher-list', compact('users', 'current_page', 'per_page', 'programmes', 'qualifications', 'majors'));
        // return $this->userService->indexView('list.teacher-list',$this->userService->getTeachers($school_id));
    }

    /**
     * Display a list of all students based on school_id.
     * @param $school_id
     */
    public function indexStudent($school_id){
        $majors = Major::query()->get();
        $programmes = Programme::query()->get();
        $qualifications = Qualification::query()->get();
        $users = $this->userService->getStudents($school_id);
        $current_page = $users->currentPage();
        $per_page = $users->perPage();
        return view('list.student-list', compact('users', 'current_page', 'per_page', 'programmes', 'qualifications', 'majors'));
        // return $this->userService->indexView('list.student-list', $this->userService->getStudents($school_id));
    }

    /**
     * @param $school_code
     * @param $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexOther($school_code, $role){
        if($this->userService->isAccountant($role))
            return $this->userService->indexOtherView('accounts.accountant-list', $this->userService->getAccountants());
        else if($this->userService->isLibrarian($role))
            return $this->userService->indexOtherView('library.librarian-list', $this->userService->getLibrarians());
        else
            return view('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegisterStudent()
    {
        $classes = MyClass::query()
            ->bySchool(\Auth::user()->school->id)
            ->pluck('id');

        $sections = Section::with('class')
            ->whereIn('class_id', $classes)
            ->get();

        session([
            'register_role' => 'student',
            'register_sections' => $sections,
        ]);

        return redirect()->route('register');
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sectionStudents($section_id)
    {
        $students = $this->userService->getSectionStudentsWithSchool($section_id);

        return view('profile.section-students', compact('students'));
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promoteSectionStudents(Request $request, $section_id)
    {
        if($this->userService->hasSectionId($section_id))
            return $this->userService->promoteSectionStudentsView(
                $this->userService->getSectionStudentsWithStudentInfo($request, $section_id),
                MyClass::with('sections')->bySchool(\Auth::user()->school_id)->get(),
                $section_id
            );
        else
            return $this->userService->promoteSectionStudentsView([], [], $section_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promoteSectionStudentsPost(Request $request)
    {   
        return $this->userService->promoteSectionStudentsPost($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordGet()
    {
        return view('profile.change-password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordPost(ChangePasswordRequest $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->user()->fill([
              'password' => Hash::make($request->new_password),
            ])->save();

            return back()->with('status', __('Saved'));
        }

        return back()->with('error-status', __('Passwords do not match.'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonateGet()
    {
        if (app('impersonate')->isImpersonating()) {
            Auth::user()->leaveImpersonation();
            return (Auth::user()->role == 'master')?redirect('/masters') : redirect('/home');
        }
        else {
            return view('profile.impersonate', [
                'other_users' => $this->user->where('id', '!=', auth()->id())->get([ 'id', 'first_name', 'last_name', 'role' ])
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonate(ImpersonateUserRequest $request)
    {
        $user = $this->user->find($request->id);
        Auth::user()->impersonate($user);
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $password = $request->password;
            $tb = $this->userService->storeStudent($request);
            try {
                // Fire event to store Student information
                if(event(new StudentInfoUpdateRequested($request,$tb->id))){
                    // Fire event to send welcome email
                    event(new UserRegistered($tb, $password));
                } else {
                    throw new \Exeception('Event returned false');
                }
            } catch(\Exception $ex) {
                Log::info('Email failed to send to this address: '.$tb->email.'\n'.$ex->getMessage());
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeAdmin($request);
        try {
            // Fire event to send welcome email
            // event(new userRegistered($userObject, $plain_password)); // $plain_password(optional)
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTeacher(CreateTeacherRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'teacher');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAccountantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAccountant(CreateAccountantRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'accountant');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateLibrarianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLibrarian(CreateLibrarianRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'librarian');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($code)
    {
        $user = $this->userService->getUserByCode($code);

        return view('profile.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        $majors = Major::query()->get();
        $programmes = Programme::query()->get();
        // $classes = MyClass::query()
        //     ->bySchool(\Auth::user()->school_id)
        //     ->pluck('id')
        //     ->toArray();

        // $sections = Section::query()
        //     ->whereIn('class_id', $classes)
        //     ->get();

        // $departments = Department::query()
        //     ->bySchool(\Auth::user()->school_id)
        //     ->get();

        return view('profile.edit', [
            'user' => $user,
            // 'sections' => $sections,
            // 'departments' => $departments,
            'programmes' => $programmes,
            'majors' => $majors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tb = User::find($request->id);
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'code' => 'required|string',
            'gender'  => 'required|string',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'programme_id' => 'required|integer',
            'qualification_id' => 'nullable|integer',
            'major_id' => 'nullable|integer',
            'enrolled_date' => 'required|string',
            'about' => 'nullable|string',
        ]);
        
        $tb->id = $request->id;
        $tb->first_name = $request->first_name;
        $tb->last_name = $request->last_name;
        $tb->code = $request->code;
        $tb->gender = $request->gender;
        $tb->email = $request->email;
        $tb->phone_number = $request->phone_number;
        $tb->address = $request->address;
        $tb->programme_id = $request->programme_id;
        $tb->qualification_id = $request->qualification_id;
        $tb->major_id = $request->major_id;
        $tb->enrolled_date = $request->enrolled_date;
        $tb->about = $request->about;
        if ($tb->save()) {
            return back()->with('status', __('User Saved'));
        }
        else{
            return back()->with('status', __('UPDATE FAILED!'));
        }
    }

    // public function update(UpdateUserRequest $request)
    // {
    //     DB::transaction(function () use ($request) {
    //         $tb = $this->user->find($request->user_id);
    //         $tb->first_name = $request->first_name;
    //         $tb->email = (!empty($request->email)) ? $request->email : '';
    //         // $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
    //         $tb->phone_number = $request->phone_number;
    //         $tb->address = (!empty($request->address)) ? $request->address : '';
    //         $tb->about = (!empty($request->about)) ? $request->about : '';
	// 		if (!empty($request->pic_path)) {
	// 			$tb->pic_path = $request->pic_path;
	// 		}
    //         if ($request->user_role == 'teacher') {
    //             $tb->department_id = $request->department_id;
    //             $tb->section_id = $request->class_teacher_section_id;
    //         }
    //         if ($tb->save()) {
    //             if ($request->user_role == 'student') {
    //                 // $request->validate([
    //                 //   'session' => 'required',
    //                 //   'version' => 'required',
    //                 //   'birthday' => 'required',
    //                 //   'religion' => 'required',
    //                 //   'father_name' => 'required',
    //                 //   'mother_name' => 'required',
    //                 // ]);
    //                 try{
    //                     // Fire event to store Student information
    //                     event(new StudentInfoUpdateRequested($request,$tb->id));
    //                 } catch(\Exception $ex) {
    //                     Log::info('Failed to update Student information, Id: '.$tb->id. 'err:'.$ex->getMessage());
    //                 }
    //             }
    //         }
    //     });

    //     return back()->with('status', __('Saved'));
    // }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
       $admin = $this->user->find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        // return ($this->user->destroy($id))?response()->json([
      //   'status' => 'success'
      // ]):response()->json([
      //   'status' => 'error'
      // ]);
    }
}
