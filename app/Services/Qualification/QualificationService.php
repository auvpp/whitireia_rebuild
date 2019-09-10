<?php
namespace App\Services\Qualification;

use App\Major;
use App\Qualification;
use Illuminate\Support\Facades\DB;

class QualificationService {

    protected $majors;

    public function getMajorsByQualificationId($id){
        return Major::with('courses', 'users', 'qualification')
                    ->where('qualification_id', $id)
                    ->get();
    }
}