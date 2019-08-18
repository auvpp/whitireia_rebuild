<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index(){
        return view('programmes.business');
    }

    public function business(){
        return view('programmes.business');
    }

    public function it(){
        return view('programmes.it');
    }

}
