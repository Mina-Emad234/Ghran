<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('nationality',30);
            $table->enum('gender',['male','female']);
            $table->string('city',50);
            $table->integer('age');
            $table->string('mobile',11)->unique();
            $table->string('address');
            $table->string('marital_status',30);
            $table->string('email',50)->unique();
            $table->string('qualification',50);
            $table->string('major',50);
            $table->string('job',30);
            $table->string('skills',100);
            $table->string('voluntary',100);
            $table->string('favor_time',100);
            $table->string('image',100);
            $table->string('parent_name',50);
            $table->string('parent_email',50);
            $table->string('parent_tel',15);
            $table->string('parent_mobile',11);
            $table->string('parent_job',30);
            $table->string('fav_days',50);
            $table->boolean('read')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
