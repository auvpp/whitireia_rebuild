<?php

namespace App\Http\Controllers;

use App\Qualification;
use Illuminate\Http\Request;
use App\Services\Programme\ProgrammeService;

class ProgrammeController extends Controller
{
    protected $programmeService;
    protected $qualifications;

    public function __construct(ProgrammeService $programmeService){
        $this->programmeService = $programmeService;
    }
    
    public function business(){
        $qualifications = $this->programmeService->getQualificationsByBusiness();
        return view('programmes.business', compact('qualifications'));
    }

    public function it(){
        $qualifications = $this->programmeService->getQualificationsByIT();
        return view('programmes.it', compact('qualifications'));
    }
}
