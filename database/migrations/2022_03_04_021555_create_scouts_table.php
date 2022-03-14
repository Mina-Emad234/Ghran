<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scouts', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('image',50);
            $table->string('school',50);
            $table->string('grade',30);
            $table->integer('age');
            $table->string('interests',50);
            $table->string('address',50);
            $table->string('mobile',11);
            $table->string('email',50);
            $table->string('parent_name',50);
            $table->string('parent_job',30);
            $table->string('parent_tel',15);
            $table->string('parent_mobile',11);
            $table->string('parent_email',50);
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
        Schema::dropIfExists('scouts');
    }
}
