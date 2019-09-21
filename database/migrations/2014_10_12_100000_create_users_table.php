<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('course_token')->default(1);
            $table->integer('school_id')->nullable();
            //$table->integer('code')->nullable();//school code Auto generated
            $table->string('code')->unique();//Auto generated
            $table->string('gender')->default('');
            //$table->string('blood_group')->default('');
            //$table->string('nationality')->default('');
            $table->string('phone_number')->unique()->default('');
            $table->string('address')->nullable()->default('');
            $table->string('pic_path')->default('');
            $table->tinyInteger('verified')->default(1);
            $table->integer('major_id')->nullable();
            $table->integer('qualification_id')->nullable();
            $table->integer('programme_id')->nullable();
            $table->string('enrolled_date')->nullable();
            $table->text('about')->default('');
            //$table->integer('section_id')->unsigned()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
