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
            $table->string('current_offered');
            $table->string('next_offered');
            $table->string('prerequisite')->nullable()->default('None');
            $table->text('description')->nullable()->default('');
            $table->integer('teacher_id')->default(0);
            $table->string('teacher')->default('TBA');
            $table->timestamps();
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
