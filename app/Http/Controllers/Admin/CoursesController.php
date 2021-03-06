<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CoursesController extends Controller
{
    use GhranTrait;
    public function index()
    {
            $courses = Course::withCount('videos')->where('course_payable',0)->orderBy('order', 'desc')->paginate(10);
            return view('admin.courses.index', compact('courses'));
    }

    public function payable(){
        $courses = Course::withCount('applicants')->where('course_payable',1)->orderBy('order', 'desc')->paginate(10);
        return view('admin.courses.payable', compact('courses'));
    }


    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(CourseRequest $request)
    {
        try{
            $active = $this->checkActive($request);
            $file_name = $this->upload($request->image,'uploads/courses');
            if($request->has('course_payable')){
                $payable=1;
                $price=$request->price;
            }else{
                $payable=0;
                $price=NULL;
                if(!File::isDirectory(public_path('uploads/v_images/'.$request->name))) {
                    File::makeDirectory(public_path('uploads/v_images/' . $request->name));
                }

                if(!File::isDirectory(public_path('uploads/v_videos/'.$request->name))) {
                    File::makeDirectory(public_path('uploads/v_videos/' . $request->name));
                }
            }
            $add = Course::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'duration'=>$request->duration,
                'licence'=>$request->licence,
                'image'=>$file_name,
                'status'=>$active,
                'order'=>Course::max('order') + 1,
                'course_payable'=>$payable,
                'price'=>$price
            ]);
            if($payable) {
                return redirect()->route('courses.payable')->with(['success_msg' => '???? ?????????? ???????? ??????????']);
            }else{
                return redirect()->route('courses.index')->with(['success_msg' => '???? ?????????? ???????? ??????????']);
            }
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }
    }

    public function edit(Course $course)
    {
        return view('admin.courses.update',compact('course'));
    }

    public function update(courseRequest $request,Course $course)
    {
        try{
            $active = $this->checkActive($request);
            if($request->has('course_payable')){
                $payable=1;
                $price=$request->price;
            }else{
                $payable=0;
                $price=NULL;
                if(File::isDirectory(public_path('uploads/v_images/'.$course->name))) {
                    rename(public_path('uploads/v_images/' . $course->name), public_path('uploads/v_images/' . $request->name));
                }

                if(File::isDirectory(public_path('uploads/v_videos/'.$course->name))) {
                    rename(public_path('uploads/v_videos/' . $course->name), public_path('uploads/v_videos/' . $request->name));
                }
            }
            $this->updateUpload($request,'image','uploads/courses/',$course->image,$course);
                $data['name'] = $request->name;
                $data['description'] = $request->description;
                $data['duration'] = $request->duration;
                $data['licence'] = $request->licence;
                $data['status'] = $active;
                $data['course_payable'] = $payable;
                $data['price'] = $price;
                $course->update($data);
            if($payable) {
                return redirect()->route('courses.payable')->with(['success_msg' => '???? ?????????? ???????? ??????????']);
            }else {
                return redirect()->route('courses.index')->with(['success_msg' => '???? ?????????? ???????????? ??????????']);
            }
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }
    }

    public function destroy(Course $course){
        try{
            if($course->course_payable == 0) {
                foreach ($course->videos as $video) {
                    unlink(public_path('uploads/v_videos/'.$course->name.'/'.$video->video));
                    unlink(public_path('uploads/v_images/'.$course->name.'/'.$video->image));
                }
                File::deleteDirectory(public_path('uploads/v_videos/'.$course->name));
                File::deleteDirectory(public_path('uploads/v_images/'.$course->name));

            }
            $this->deleteWithImage('uploads/courses/'.$course->image,$course);
            return redirect()->route('courses.index')->with(['success_msg'=>'???? ?????? ???????????? ??????????']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }
    }

    public function activate(Course $course){
        return $this->modelActivation($course,1,'???? ?????????? ???????????? ??????????','courses.index');
    }

    public function deactivate(Course $course){
        return $this->modelActivation($course,0,'???? ?????????? ?????????? ???????????? ??????????','courses.index');
    }

}
