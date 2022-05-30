<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('site_section_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('link',200)->nullable();
            $table->boolean('active');
            $table->foreign('site_section_id')->references('id')->on('site_sections')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('site_links')->onDelete('cascade');
            $table->unique(['name','site_section_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_links');
    }
}
