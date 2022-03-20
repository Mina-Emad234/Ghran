<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MediaRequest;
use App\Mail\MediaMail;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MediaController extends Controller
{
    public function registerPage()
    {
        return view('site.media.send');
    }
    public function send(MediaRequest $request)
    {
        try {
            Media::create([
                'name'=>$request->name,
                'identity'=>$request->identity,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'course'=>$request->course,
            ]);
            $data=['name'=>$request->name];
            Mail::to($request->email)->send(new MediaMail($data));
            setcookie('media_sent', $request->email, 2147483647,'/');
            return redirect()->route('media.register')->with(['media_success'=>'تم تسجيل البيانات بنجاح']);
        }catch (\Exception $ex){
            return redirect()->back()->withInput()->with(['media_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

}
