<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question',200);
            $table->string('answer1',100);
            $table->string('answer2',100);
            $table->string('answer3',100);
            $table->string('answer4',100);
            $table->boolean('active');
            $table->integer('order');
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
        Schema::dropIfExists('vote_questions');
    }
}
