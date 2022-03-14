<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Info;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('site.pages.about');
    }
    public function programs()
    {
        return view('site.pages.programs');
    }
    public function support()
    {
        return view('site.pages.support');
    }
    public function members()
    {
        return view('site.pages.members');
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
