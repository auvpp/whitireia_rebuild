<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'level', 'programme_id', 'credit', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * One qualification has many majors.
     */
    public function majors()
    {
      return $this->hasMany('App\Major');
    }

    /**
     * One qualification has many users.
     */
    public function users()
    {
      return $this->hasMany('App\User');
    }

    /**
     * One qualification belongs to only one programme.
     */
    public function programme()
    {
      return $this->belongsTo('App\Programme');
    }
}
