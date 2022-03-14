<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseApplicant;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CourseApplicantController extends Controller
{
    use GhranTrait;
    public function index($course_id='')
    {
        if(!empty($course_id)) {
            $applicants = CourseApplicant::with('course')->where('course_id',$course_id)->orderByDesc('id')->paginate(10);
        }else{
            $applicants = CourseApplicant::with('course')->orderByDesc('id')->paginate(10);
        }
        return view('admin.c_applicant.index',compact('applicants'));
    }

    public function read($id)
    {
        $applicant = $this->checkModel(new CourseApplicant,$id);
        $read=$applicant->update(['read'=>1]);
        return view('admin.c_applicant.show',compact('applicant'));
    }


    public function delete($id)
    {
        try{
            $applicant = $this->checkModel(new CourseApplicant,$id);
            $applicant->delete();
            return redirect()->route('c_applicant.index')->with(['success_msg' => "تم حذف متقدم بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
