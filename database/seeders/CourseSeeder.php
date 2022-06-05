<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\DB::table('course')->where('course_payable',0)->pluck('name')->toArray() as $course){
            if(FILE::isDirectory(public_path('uploads/v_images/'.$course))) {
                FILE::deleteDirectory(public_path('uploads/v_images/' . $course), 0777, true, true);
            }
            if(FILE::isDirectory(public_path('uploads/v_videos/'.$course))) {
                FILE::deleteDirectory(public_path('uploads/v_videos/' . $course), 0777, true, true);
            }
        }
        $images = glob(public_path('uploads/courses/*.*'));
        foreach ($images as $image) {
            unlink($image);
        }
        Schema::disableForeignKeyConstraints();
        Course::truncate();
        Schema::enableForeignKeyConstraints();
        Course::factory(50)->create();

        foreach(\DB::table('course')->where('course_payable',0)->pluck('name')->toArray() as $course){
            FILE::makeDirectory(public_path('uploads/v_images/'.$course),0777,true,true);
            FILE::makeDirectory(public_path('uploads/v_videos/'.$course),0777,true,true);
        }
    }
}
