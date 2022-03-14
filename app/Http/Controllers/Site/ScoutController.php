<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ScoutRequest;
use App\Mail\ScoutMail;
use App\Models\Scout;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScoutController extends Controller
{
    use GhranTrait;

    public function getPage()
    {
        return view('site.scout.send');
    }
    public function send(ScoutRequest $request)
    {
        try {
            $file_name = $this->upload($request->image,'uploads/scouts');
            Scout::create([
                'name'=>$request->name,
                'school'=>$request->school,
                'grade'=>$request->grade,
                'interests'=>$request->interests,
                'age'=>$request->age,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'email'=>$request->email,
                'parent_name'=>$request->parent_name,
                'parent_email'=>$request->parent_email,
                'parent_mobile'=>$request->parent_mobile,
                'parent_tel'=>$request->parent_tel,
                'image'=>$file_name,
                'parent_job'=>$request->parent_job,
            ]);
            $data=['name'=>$request->name];
            Mail::to($request->email)->send(new ScoutMail($data));
            setcookie('scout_sent', $request->email, 2147483647,'/');
            return redirect()->route('scout.page')->with(['scout_success'=>'تم تسجيل البيانات بنجاح']);
        }catch (\Exception $ex){
            return redirect()->back()->withInput()->with(['scout_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }


}
