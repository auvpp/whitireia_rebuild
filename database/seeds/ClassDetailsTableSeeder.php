<?php

use App\ClassDetail;
use Illuminate\Database\Seeder;

class ClassDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classdetails')->insert([
            'user_id' => 23,     // Arkar
            'course_id' => 247,  // IT6x87
            'class_id' => 0,
            'active'   => 1,
            'term'     => 'T2-2019',
            'approved_credit' => 0,
            'grade_id'     => 0,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

    }
}