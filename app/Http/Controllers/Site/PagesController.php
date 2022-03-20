<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Info;
use App\Models\SiteContent;
use App\Models\SiteSection;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        $about= SiteSection::with(['site_contents'=>function($query){
            $query->where(['active'=>1]);
        }])->where('name','about')->first()->site_contents;
        return view('site.pages.about',compact('about'));
    }
    public function programs()
    {
        $programs = SiteSection::where(['name'=>'programs'])->first()->site_contents()->paginate(10);
        return view('site.pages.programs',compact('programs'));
    }
    public function support()
    {
        $support = SiteSection::with(['site_contents'=>function($query){
            $query->where(['active'=>1])->paginate(10);
        }])->where(['name'=>'support','section_type'=>'pages'])->first()->site_contents;
        $image=SiteSection::with('image')->where('name','support')->first()->image->image;
        return view('site.pages.support',compact('image','support'));
    }
    public function members()
    {
        $members = SiteSection::where(['name'=>'members'])->first()->site_contents()->paginate(10);
        return view('site.pages.members',compact('members'));
    }

    public function info()
    {
        $infos = Info::where('active',1)->get();
        return view('site.pages.info',compact('infos'));
    }

    public function sitemap()
    {
        $categories = BlogCategory::get();
        return view('site.pages.sitemap',compact('categories'));
    }
}
