<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseApplicant;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CourseApplicantsController extends Controller
{
    use GhranTrait;
    public function index($course_id='')
    {
        if(!empty($course_id)) {
            $course = Course::with('applicants')->where('id',$course_id)->first();
            $applicants = $course->applicants()->orderByDesc('id')->paginate(10);;
            return view('admin.course-applicants.index',compact('applicants','course'));
        }else{
            $applicants = CourseApplicant::with('course')->orderByDesc('id')->paginate(10);
            return view('admin.course-applicants.index',compact('applicants'));
        }
    }

    public function read(CourseApplicant $applicant)
    {
        $applicant->update(['read'=>1]);
        $applicant->load('course');
        return view('admin.course-applicants.show',compact('applicant'));
    }


    public function delete(CourseApplicant $applicant)
    {
        try{
            $applicant->delete();
            return redirect()->route('course.applicants.index')->with(['success_msg' => "تم حذف متقدم بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
