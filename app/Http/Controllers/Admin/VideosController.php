<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Course;
use App\Models\Video;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPUnit\Exception;

class VideosController extends Controller
{
    use GhranTrait;
    public function index()
    {
            $videos = Video::with('course')->orderBy('order','desc')->paginate(10);
        return view('admin.videos.index',compact('videos'));
    }

    public function getCourseVideos($course_id)
    {
          $course = Course::with('videos')->where('id',$course_id)->first();

        $videos = $course->videos()->orderBy('order','desc')->paginate(10);;
        return view('admin.videos.index',compact('videos','course'));
    }

    public function create()
    {
        $courses=Course::where(['status'=>1,'course_payable'=>0])->get();
        return view('admin.videos.create',compact('courses'));
    }

    public function store(VideoRequest $request)
    {
        try{
            $active = $this->checkActive($request);
            $course = Course::where('course_payable',0)->find($request->course_id);
            $video_name = $this->upload($request->video,'uploads/v_videos/'.$course->name);
            $file_name = $this->upload($request->image,'uploads/v_images/'.$course->name);
            if(!$course)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

            Video::create([
                'name'=>$request->name,
                'author'=>$request->author,
                'course_id'=>$course->id,
                'image'=>$file_name,
                'video'=>$video_name,
                'status'=>$active,
                'order'=>Video::max('order') + 1
            ]);
            return redirect()->route('videos.index')->with(['success_msg'=>'تم إضافة فيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function show(Video $video)
    {
        $video->load('course');
        return view('admin.videos.show',compact('video'));
    }

    public function edit(Video $video)
    {
        $courses=Course::where(['status'=>1,'course_payable'=>0])->get();
        return view('admin.videos.update',compact('video','courses'));
    }

    public function update(VideoRequest $request,Video $video)
    {
        try{
            $video->load('course');
            $active = $this->checkActive($request);
            $course = Course::where('course_payable',0)->find($request->course_id);
            if(!$course)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

            if($video->course->id == $course->id){
                $this->updateUpload($request,'video','uploads/v_videos/'.$course->name,$video->video,$video);
                $this->updateUpload($request,'image','uploads/v_images/'.$course->name,$video->image,$video);
            }else{
                if($request->has('image') && $request->has('video')) {
                    if (file_exists('uploads/v_videos/' . $course->name . '/' . $video->video) && $video->video != '') {
                        unlink('uploads/v_videos/' . $course->name . '/' . $video->video);
                        $video = $this->upload($request->video, 'uploads/v_videos/' . $course->name );
                        $data['video'] = $video;
                    }

                    if (file_exists('uploads/v_images/' . $course->name . '/' . $video->image) && $video->image != '') {
                        unlink('uploads/v_images/' . $course->name . '/' . $video->image);
                        $image = $this->upload($request->image, 'uploads/v_images/' . $course->name );
                        $data['image'] = $image;
                    }
                }else{
                    File::move('uploads/v_videos/' . $video->course->name . '/' . $video->video,'uploads/v_videos/' .$course->name.'/'.$video->video);
                    File::move('uploads/v_images/' . $video->course->name . '/' . $video->image,'uploads/v_images/' .$course->name.'/'.$video->image);
                }
            }


            $data['name'] = $request->name;
            $data['author'] = $request->author;
            $data['course_id'] = $course->id;
            $data['status'] = $active;
            $video->update($data);
            return redirect()->route('videos.index')->with(['success_msg' => 'تم تحديث الفيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Video $video){
        try{
            $video->load('course');
            if(file_exists('uploads/v_videos/'.$video->course->name.'/'.$video->video)){
                unlink('uploads/v_videos/'.$video->course->name.'/'.$video->video);
            }
            $this->deleteWithImage('uploads/v_images/'.$video->course->name.'/'.$video->image,$video);

            return redirect()->route('videos.index')->with(['success_msg'=>'تم حذف الفيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Video $video){
        return $this->modelActivation($video,1,'تم تفعيل الفيديو بنجاح','videos.index');
    }

    public function deactivate(Video $video){
        return $this->modelActivation($video,0,'تم إلغاء تفعيل الفيديو بنجاح','videos.index');
    }
    public function sort(Video $video,$direction = 'up')
    {
        return $this->sortData($video,'videos.index',$direction);
    }

}
