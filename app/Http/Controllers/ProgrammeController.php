<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Http\Requests\Exam\CreateExamRequest;

class ProgrammeController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService){
        $this->examService = $examService;
    }
    
    public function index(){
        return view('programmes.business');
    }

    public function business(){
        return view('programmes.business');
    }

    public function it(){
        return view('programmes.it');
    }

    public function bit(){
        $exams = $this->examService->getLatestExamsBySchoolIdWithPagination();
        return view('programmes.list',compact('exams'));
    }

}
