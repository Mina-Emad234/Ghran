<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\MailRequest;
use App\Models\Blog;
use App\Models\Course;
use App\Models\ListMail;
use App\Models\Partner;
use App\Models\SiteSection;
use App\Models\VoteQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class HomeController extends Controller
{
    public function index(){
        $data['image']=SiteSection::with('image')->where('name','main')->first()->image->image;
        $data['latest_tickers'] = Blog::where(['category_id'=>2,'active'=>1])->get();
        $data['offer'] = SiteSection::where(['name'=>'offers'])->first()->site_contents->first()->body;
        $data['paid_course'] = Course::where(['active'=>1,'course_payable'=>1])->orderByDesc('price')->first();
        $article = Blog::where(['category_id'=>1,'active'=>1])->latest()->first();
        $news = Blog::where(['category_id'=>2,'active'=>1])->latest()->first();
        $woman = Blog::where(['category_id'=>3,'active'=>1])->latest()->first();
        $data['testimonials'] = Blog::where(['category_id'=>4,'active'=>1])->orderBy('id','desc')->limit(10)->get();
        $data['testimonials_count'] = Blog::where(['category_id'=>4,'active'=>1])->orderBy('id','desc')->limit(5)->count();
        $data['partners']=Partner::where('active',1)->get();
        $vote=VoteQuestion::where('active',1)->first();
        return view('site.blog.home',compact('data','article','news','woman','vote'));
    }

    public function send_mail(MailRequest $request)
    {
        try {
                ListMail::create([
                   'name'=>$request->name,
                   'email'=>$request->mail
                ]);
            setcookie('mail_sent',$request->mail,2147483647);
            return redirect()->route('home')->with(['success'=>'تم تسجيل البريد الإلكتروني بنجاح']);
        }catch (Exception $r){
            return redirect()->back()->withInput()->with(['error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }
}
