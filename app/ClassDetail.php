<?php

namespace App;
use App\Model;

class ClassDetail extends Model
{
    protected $table = "classdetails";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id', 'grade_id', 'approved_credit', 'course_id', 'term', 'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * One ClassDetail belongs to only one MyClass.
    */
    public function myClass()
    {
        return $this->belongsTo('App\MyClass', 'class_id');
    }

    /**
     * One ClassDetail belongs to only one course.
    */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    /**
     * One ClassDetail belongs to only one grade.
    */
    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

    /**
     * One ClassDetail belongs to only one user.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
