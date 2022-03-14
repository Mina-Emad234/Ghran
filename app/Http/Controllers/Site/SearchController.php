<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        if ($request->has('search')){
            $search=$request->search;
            $tag_data = Tag::with(['blogs'=>function($query){
                $query->where('active',1);
            }])->where('name','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%')->get();
            $tag_blogs=[];
            foreach ($tag_data as $data){
                array_push($tag_blogs,$data->blogs) ;
            }
            $blog_data=Blog::where('title','like','%'.$search.'%')->orWhere('slug','like','%'.$search.'%')->where('active',1)->get();
            $results=[];
            array_push($results,$blog_data);
             $results=array_unique(array_merge($results,$tag_blogs));
            return view('site.search.index',compact('search','results'));
        }else{
            return view('site.search.index');
        }
    }
}
