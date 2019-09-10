<?php
namespace App\Services\Programme;

use App\Programme;
use App\Qualification;
use Illuminate\Support\Facades\DB;

class ProgrammeService {

    protected $programme;

    public function getQualificationsByBusiness(){
        $programme = DB::table('programmes')->where('name', 'Business')->first();
        return Qualification::with('programme', 'majors')
                    ->where('programme_id', $programme->id)
                    ->get();
    }

    public function getQualificationsByIT(){
        $programme = DB::table('programmes')->where('name', 'IT')->first();
        return Qualification::with('programme', 'majors')
                    ->where('programme_id', $programme->id)
                    ->get();
    }
}