<?php

namespace App;

use App\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * One Grade has many ClassDetails.
    */
    public function classDetails()
    {
        return $this->hasMany('App\ClassDetail');
    }

    // /**
    //  * Get the course record associated with the user.
    // */
    // public function course()
    // {
    //     return $this->belongsTo('App\Course');
    // }
    // /**
    //  * Get the student record associated with the user.
    // */
    // public function student()
    // {
    //     return $this->belongsTo('App\User');
    // }
    // /**
    //  * Get the teacher record associated with the user.
    // */
    // public function teacher()
    // {
    //     return $this->belongsTo('App\User');
    // }

    // /**
    //  * Get the exam name record associated with the exam.
    // */
    // public function exam()
    // {
    //     return $this->belongsTo('App\Exam');
    // }
}
