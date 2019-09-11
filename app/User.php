<?php

namespace App;

use App\Model;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasApiTokens, Notifiable, Impersonate, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role', /* school code*/'code', 'active', 'school_id', 'code', 'address', 'phone_number', /* 'blood_group' , 'nationality' , */ 'gender', 'major_id', 'programme_id', 'qualification_id', 'enrolled_date', 'about' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeStudent($q)
    {
        return $q->where('role', 'student');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * One user belongs to only one school.
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    /**
     * One user belongs to only one programme.
     */
    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }

    /**
     * One user belongs to only one major.
     */
    public function major()
    {
        return $this->belongsTo('App\Major');
    }

    /**
     * One user belongs to only one qualification.
     */
    public function qualification()
    {
        return $this->belongsTo('App\Qualification');
    }

    /**
     * One user has many MyClasses.
     */
    public function myClasses()
    {
        return $this->hasMany('App\MyClass');
    }

    // public function department()
    // {
    //     return $this->belongsTo('App\Department','department_id', 'id');
    // }

    // public function studentInfo(){
    //     return $this->hasOne('App\StudentInfo','student_id');
    // }

    // public function studentBoardExam(){
    //     return $this->hasMany('App\StudentBoardExam','student_id');
    // }

    // public function notifications(){
    //     return $this->hasMany('App\Notification','student_id');
    // }

    public function hasRole(string $role): bool
    {
        return $this->role == $role ? true : false;
    }
}
