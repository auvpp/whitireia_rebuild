<?php

namespace App;

use App\Model;

class Programme extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * One programme has many users.
     */
    public function users()
    {
      return $this->hasMany('App\User');
    }

    /**
     * One programme has many qualifications.
     */
    public function qualifications()
    {
      return $this->hasMany('App\Qualification');
    }
    

}
