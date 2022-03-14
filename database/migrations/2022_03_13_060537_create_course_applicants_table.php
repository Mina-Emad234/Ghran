<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('name',100);
            $table->string('email',100);
            $table->string('mobile',11);
            $table->string('marita_status',50);
            $table->string('job',50);
            $table->string('city',50);
            $table->integer('age');
            $table->boolean('read')->default(0);
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
            $table->unique(['course_id','email','mobile']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_applicants');
    }
}
