<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApplicantRequest;
use App\Models\Course;
use App\Models\CourseApplicant;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class ApplicantsController extends Controller
{

    public function index()
    {
        $applicants = CourseApplicant::with('course:id,name')->orderByDesc('id')->paginate(5);
        $i=0;
        foreach ($applicants as $applicant){
            unset($applicants[$i]);
            $applicants->push(array_merge($applicant->toArray(),['link'=>url('/api/courses/applicants_api/'.$applicant->id)]));
            $i++;
        }
        return $applicants;
    }


    public function show(CourseApplicant $applicant)
    {
        $applicant->load('course:id,name');
        return response($courseApplicant);
    }


    public function destroy(CourseApplicant $applicant)
    {
        try{
            $applicant->delete();
            return response(['message'=>'تم حذف بيانات متقدم للكورس بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function store(ApplicantRequest $request){
        try{
            if($request->has('course_id')) {
                $course = Course::where(['status' => 1, 'course_payable' => 1])->find($request->course_id);
            }else{
                return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
            }
            $applicant=CourseApplicant::create([
            'payment_method' => $request->payment_method,
            'name' => $request->name,
            'course_id' => $course->id,
            'city' => $request->city,
            'age' => $request->age,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'marital_status' => $request->marital_status,
            'email' => $request->email,
            'job' => $request->job,
        ]);
        return response($applicant);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

}
