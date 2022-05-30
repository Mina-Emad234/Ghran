<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VideosRequest;
use App\Models\Course;
use App\Models\Video;
use App\Traits\GhranTrait;
use PHPUnit\Exception;

class VideosController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::with('course:id,name')->orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($videos as $video){
            unset($videos[$i]);
            $videos->push(array_merge($video->toArray(),['link'=>url('/api/videos/'.$video->id)]));
            $i++;
        }
        return response($videos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideosRequest $request)
    {
        try{
            $video_name = $this->upload($request->video,'uploads/v_videos');
            $file_name = $this->upload($request->image,'uploads/v_images');
            $course = Course::where('course_payable',0)->find($request->course_id);
            if(!$course)
                return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى لا يمكن إضافة الفيديو لتلك الدورة']);
            $video = Video::create([
                'name'=>$request->name,
                'author'=>$request->author,
                'course_id'=>$course->id,
                'image'=>$file_name,
                'video'=>$video_name,
                'active'=>$request->active,
                'order'=>Video::max('order') + 1
            ]);
            return $video;
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $video->load('course:id,name');
        return response($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideosRequest $request, Video $video)
    {
        try {
            if($request->has('id') && $request->id == $video->id) {
                $this->updateUpload($request, 'video', 'uploads/v_videos/', $video->video, $video);
                $this->updateUpload($request, 'image', 'uploads/v_images/', $video->image, $video);
                $data = $request->except('image', 'video');
                if ($request->has('course_id')) {
                    $course = Course::where('course_payable', 0)->find($request->course_id);
                    if (!$course)
                        return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى لا يمكن إضافة الفيديو لتلك الدورة']);
                    $data['course_id'] = $course->id;
                }
                $video->update($data);
                return response($video);
            }
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        try{
            if(file_exists('uploads/v_videos/'.$video->video)){
                unlink('uploads/v_videos/'.$video->video);
            }
            $this->deleteWithImage('uploads/v_images/'.$video->image,$video);
            return response(['message'=>'تم حذف الفيديو بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
