<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active', 'qualification_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * One major has many users.
     */
    public function users()
    {
      return $this->hasMany('App\User');
    }

    /**
     * One major has many courses.
     */
    public function courses()
    {
      return $this->hasMany('App\Course');
    }

    /**
     * One major belongs to only one qualification.
     */
    public function qualification()
    {
      return $this->belongsTo('App\Qualification');
    }

}
