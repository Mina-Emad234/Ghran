<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('identity',16);
            $table->string('mobile',11)->unique();
            $table->string('email',50)->unique();
            $table->enum('course',['التصوير الفوتوغرافي','تصويــــر الفيديو','إدارة المواقع الالكترونية',
                                                    'المونتـــــــــاج','التصميـــــــــم','التمثيـــــــــل']);
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
        Schema::dropIfExists('media');
    }
}
