<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('credit')->default(0);
            $table->string('name');
            $table->integer('major_id');
            $table->string('level');
            $table->string('type');
            $table->tinyInteger('active')->default(1);
            $table->string('current_offered')->nullable();
            $table->string('next_offered')->nullable();
            $table->string('prerequisite')->nullable()->default('');
            $table->text('description')->default('');
            $table->integer('teacher_id')->default(0);
            $table->timestamps();
            // $table->string('course_name');
            // $table->integer('class_id')->unsigned();
            // $table->string('course_type');
            // $table->string('course_time');
            // $table->string('grade_system_name');
            // $table->integer('quiz_count');
            // $table->integer('assignment_count');
            // $table->integer('ct_count');
            // $table->integer('quiz_percent');
            // $table->integer('attendance_percent');
            // $table->integer('assignment_percent');
            // $table->integer('ct_percent');
            // $table->integer('final_exam_percent');
            // $table->integer('practical_percent');
            // $table->integer('att_fullmark');
            // $table->integer('quiz_fullmark');
            // $table->integer('a_fullmark');
            // $table->integer('ct_fullmark');
            // $table->integer('final_fullmark');
            // $table->integer('practical_fullmark');
            // $table->integer('school_id')->unsigned();
            // $table->integer('exam_id')->unsigned();
            // $table->integer('teacher_id')->unsigned();
            // $table->integer('section_id')->unsigned();
            // $table->integer('user_id')->unsigned();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
