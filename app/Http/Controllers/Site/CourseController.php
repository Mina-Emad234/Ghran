<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function getPage()
    {
        $courses = Course::where('active',1)->orderByDesc('id')->paginate(5);
        return view('site.course.courses',compact('courses'));
    }

    public function getVideos($course_id)
    {
        $course = Course::with(['videos'=>function($query){
            $query->where(['active'=>1]);
        }])->find($course_id);
        return view('site.course.videos',compact('course'));
    }

    public function listenVideo($video_id)
    {
        $video = Video::find($video_id);
        return view('site.course.listen_video',compact('video'));
    }

}
