<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Exception;

class CourseController extends Controller
{
    use GhranTrait;
    public function index()
    {
            $courses = Course::withCount(['videos' => function (Builder $query) {
                $query->where('active', 1);
            }])->where('course_payable',0)->orderBy('order', 'asc')->paginate(10);
            return view('admin.course.index', compact('courses'));
    }

    public function payable(){
        $courses = Course::withCount('applicants')->where('course_payable',1)->orderBy('order', 'asc')->paginate(10);
        return view('admin.course.payable', compact('courses'));
    }


    public function create()
    {
        return view('admin.course.create');
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
            }
            $add = Course::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'duration'=>$request->duration,
                'licence'=>$request->licence,
                'image'=>$file_name,
                'active'=>$active,
                'order'=>Course::max('order') + 1,
                'course_payable'=>$payable,
                'price'=>$price
            ]);
            if($payable) {
                return redirect()->route('course.payable')->with(['success_msg' => 'تم إضافة كورس بنجاح']);
            }else{
                return redirect()->route('course.index')->with(['success_msg' => 'تم إضافة كورس بنجاح']);
            }
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $course = $this->checkModel(new Course,$id);
        return view('admin.course.update',compact('course'));
    }

    public function update($id,courseRequest $request)
    {
        try{
            $course = $this->checkModel(new Course,$id);
            $active = $this->checkActive($request);
            if($request->has('course_payable')){
                $payable=1;
                $price=$request->price;
            }else{
                $payable=0;
                $price=NULL;
            }
            $this->updateUpload($request,'image','uploads/courses/',$course->image,$course);
                $data['name'] = $request->name;
                $data['description'] = $request->description;
                $data['duration'] = $request->duration;
                $data['licence'] = $request->licence;
                $data['active'] = $active;
                $data['course_payable'] = $payable;
                $data['price'] = $price;
                $course->update($data);
            if($payable) {
                return redirect()->route('course.payable')->with(['success_msg' => 'تم تحديث كورس بنجاح']);
            }else {
                return redirect()->route('course.index')->with(['success_msg' => 'تم تحديث الكورس بنجاح']);
            }
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $course = $this->checkModel(new Course,$id);
            $this->deleteWithImage('uploads/courses/'.$course->image,$course);
            return redirect()->route('course.index')->with(['success_msg'=>'تم حذف الكورس بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new Course,$id,1,'تم تفعيل الكورس بنجاح','course.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Course,$id,0,'تم إلغاء تفعيل الكورس بنجاح','course.index');
    }

}
