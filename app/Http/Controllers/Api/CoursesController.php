<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CoursesRequest;
use App\Models\Course;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class CoursesController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($courses as $course){
            unset($courses[$i]);
            $courses->push(array_merge($course->toArray(),['link'=>url('/api/courses_api/'.$course->id)]));
            $i++;
        }
        return $courses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoursesRequest $request)
    {
        try{
            $file_name=$this->upload($request->image,'uploads/courses');
            if($request->has('course_payable')==1){
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
            $course = Course::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'duration'=>$request->duration,
                'licence'=>$request->licence,
                'image'=>$file_name,
                'status'=>$request->status,
                'order'=>Course::max('order') + 1,
                'course_payable'=>$payable,
                'price'=>$price
            ]);
            return $course;
        }catch (Exception $ex){
            return response(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if($course->course_payable == 0){
            $course->loadCount('videos')->load('videos:id,course_id,name');
            return response($course);
        }elseif ($course->course_payable == 1){
            $course->loadCount('applicants')->load('applicants:id,course_id,name,email,mobile');
            return response($course);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoursesRequest $request,Course $course)
    {
        try{
            if($request->has('id') && $request->id == $course->id) {

                $data = $request->except('image');
                $this->updateUpload($request, "image", 'uploads/courses', $course->image, $course);
                if ($request->has('name')) {
                    $data['slug'] = str_replace(' ', '-', $request->name);
                }
                if ($request->has('course_payable') == 1) {
                    $data['course_payable'] = 1;
                    $data['price'] = $request->price;
                } else {
                    $data['course_payable'] = 0;
                    $data['price'] = NULL;
                    if(File::isDirectory(public_path('uploads/v_images/'.$course->name))) {
                        rename(public_path('uploads/v_images/' . $course->name), public_path('uploads/v_images/' . $request->name));
                    }

                    if(File::isDirectory(public_path('uploads/v_videos/'.$course->name))) {
                        rename(public_path('uploads/v_videos/' . $course->name), public_path('uploads/v_videos/' . $request->name));
                    }
                }
                $course->update($data);
                return response($course);
            }
        }catch (Exception $ex){
            return response(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
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
            return response(['message'=>'???? ?????? ???????????? ??????????']);
        }catch (Exception $ex){
            return response(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????'],400);
        }
    }
}
