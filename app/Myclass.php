<?php

namespace App;

use App\Model;

class MyClass extends Model
{
    protected $table = "classes";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'class_number', 'group', 'school_id',
        'user_id', 'term_credit', 'term_id', 'year',
    ];

    /**
     * One MyClass belongs to only one user.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * One MyClass has many classDetails.
    */
    public function classDetails()
    {
        return $this->hasMany('App\ClassDetails');
    }

    /**
     * One MyClass belongs to only one term.
     */
    public function term()
    {
      return $this->belongsTo('App\Term');
    }


    // /**
    //  * Get the school record associated with the user.
    // */
    // public function school()
    // {
    //     return $this->belongsTo('App\School');
    // }

	// public function sections()
    // {
    //     return $this->hasMany('App\Section','class_id');
    // }

    // // public function exam()
    // // {
    // //     return $this->belongsTo('App\ExamForClass');
    // // }

	// public function books()
    // {
    //     return $this->hasMany('App\Book','class_id');
    // }
}
