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
            $query->where(['status'=>1]);
        }])->where('name','about')->first();
        return view('site.pages.about',compact('about'));
    }
    public function programs()
    {
        $programs = SiteSection::with(['site_contents'=>function($query){
            $query->where('status',1);
        }])->where(['name'=>'programs'])->first();
        return view('site.pages.programs',compact('programs'));
    }
    public function support()
    {
        $support = SiteSection::with(['site_contents'=>function($query){
            $query->where(['status'=>1]);
        }])->where(['name'=>'support','section_type'=>'pages'])->first();
        $image=SiteSection::with('image')->where('name','support')->first();
        return view('site.pages.support',compact('image','support'));
    }
    public function members()
    {
        $members = SiteSection::with(['site_contents'=>function($query){
            $query->where(['status'=>1]);
        }])->where(['name'=>'members'])->first();
        return view('site.pages.members',compact('members'));
    }

    public function info()
    {
        $infos = Info::where('status',1)->get();
        return view('site.pages.info',compact('infos'));
    }

    public function sitemap()
    {
        $links = SiteSection::with(['links'=>function($query){$query->where(['status'=>1]);}])->where(['name'=>'sitemap_links'])->first();
        $categories = BlogCategory::get();
        return view('site.pages.sitemap',compact('categories','links'));
    }
}
