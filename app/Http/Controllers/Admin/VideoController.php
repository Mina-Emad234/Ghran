<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Course;
use App\Models\Video;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class VideoController extends Controller
{
    use GhranTrait;
    public function index()
    {

            $videos = Video::with('course')->orderBy('order','asc')->paginate(10);

        return view('admin.video.index',compact('videos'));
    }

    public function getCourseVideos($course_id)
    {
            $videos = Video::with('course')->where('course_id',$course_id)->orderBy('order','asc')->paginate(10);

        return view('admin.video.index',compact('videos'));
    }

    public function create()
    {
        $courses=Course::where(['active'=>1,'course_payable'=>0])->get();
        return view('admin.video.create',compact('courses'));
    }

    public function store(VideoRequest $request)
    {
        try{
            $active = $this->checkActive($request);
            $video_name = $this->upload($request->video,'uploads/v_videos');
            $file_name = $this->upload($request->image,'uploads/v_images');
            $course = Course::where('course_payable',0)->find($request->course_id);
            if(!$course)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

            Video::create([
                'name'=>$request->name,
                'author'=>$request->author,
                'course_id'=>$course->id,
                'image'=>$file_name,
                'video'=>$video_name,
                'active'=>$active,
                'order'=>Video::max('order') + 1
            ]);
        return redirect()->route('video.index')->with(['success_msg'=>'تم إضافة فيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function show($id)
    {
        $video = Video::with('course')->find($id);
        if (!$video)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        return view('admin.video.show',compact('video'));
    }

    public function edit($id)
    {
        $video = $this->checkModel(new Video,$id);
        $courses=Course::where(['active'=>1,'course_payable'=>0])->get();
        return view('admin.video.update',compact('video','courses'));
    }

    public function update($id,VideoRequest $request)
    {
        try{
            $video = $this->checkModel(new Video,$id);
            $active = $this->checkActive($request);
            $course = Course::where('course_payable',0)->find($request->course_id);
            if(!$course)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);


            $this->updateUpload($request,'video','uploads/v_videos/',$video->video,$video);
            $this->updateUpload($request,'image','uploads/v_images/',$video->image,$video);
            $data['name'] = $request->name;
            $data['author'] = $request->author;
            $data['course_id'] = $course->id;
            $data['active'] = $active;
            $video->update($data);
            return redirect()->route('video.index')->with(['success_msg' => 'تم تحديث الفيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $video = $this->checkModel(new Video,$id);

            if(file_exists('uploads/v_videos/'.$video->video)){
                unlink('uploads/v_videos/'.$video->video);
            }
            $this->deleteWithImage('uploads/v_images/'.$video->image,$video);

            return redirect()->route('video.index')->with(['success_msg'=>'تم حذف الفيديو بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new Video,$id,1,'تم تفعيل الفيديو بنجاح','video.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Video,$id,0,'تم إلغاء تفعيل الفيديو بنجاح','video.index');
    }
    public function sort($direction = 'up', $id = '')
    {
        $video = $this->checkModel(new Video,$id);
        return $this->sortData(new Video,'video.index',$direction,$id);
    }

}
