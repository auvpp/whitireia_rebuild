<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->default(0);
            $table->integer('grade_id')->default(0);
            $table->integer('approved_credit')->default(0);
            $table->integer('course_id');
            $table->integer('user_id');
            $table->tinyInteger('active')->default(1);
            $table->string('term')->default('');
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
        Schema::dropIfExists('classdetails');
    }
}
