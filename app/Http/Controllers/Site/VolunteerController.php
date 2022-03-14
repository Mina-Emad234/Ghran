<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\TeamRequest;
use App\Mail\VolunteerMail;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VolunteerController extends Controller
{
    public function getPage()
    {
        return view('site.volunteer.send');
    }
    public function send(TeamRequest $request)
    {
        try {
            $file_name = $this->upload($request->image,'uploads/volunteer');
            Team::create([
                'name'=>$request->name,
                'nationality'=>$request->nationality,
                'gender'=>$request->gender,
                'city'=>$request->city,
                'age'=>$request->age,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'marital_status'=>$request->marital_status,
                'email'=>$request->email,
                'qualification'=>$request->qualification,
                'major'=>$request->major,
                'job'=>$request->job,
                'skills'=>$request->skills,
                'voluntary'=>$request->voluntary,
                'favor_time'=> implode(', ',$request->favor_time),
                'parent_name'=>$request->parent_name,
                'parent_email'=>$request->parent_email,
                'parent_mobile'=>$request->parent_mobile,
                'parent_tel'=>$request->parent_tel,
                'image'=>$file_name,
                'parent_job'=>$request->parent_job,
                'fav_days'=>implode(', ',$request->fav_days),
            ]);
            $data=['name'=>$request->name];
            Mail::to($request->email)->send(new VolunteerMail($data));
            setcookie('team_sent', $request->email, 2147483647,'/');
            return redirect()->route('volunteer.page')->with(['team_success'=>'تم تسجيل البيانات بنجاح']);
        }catch (\Exception $ex){
            return redirect()->back()->withInput()->with(['team_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

}
