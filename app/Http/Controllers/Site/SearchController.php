<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VoteRequest;
use App\Http\Requests\Site\SearchRequest;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPage(){
        return view('site.search.index');
    }
    public function search(SearchRequest $request){
        try{
            $search = $request->search;
            $tag_data = Tag::with(['blogs' => function ($query) {
                $query->where('active', 1);
            }])->where('name', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%')->get();
            $tag_blogs = [];
            foreach ($tag_data as $data) {
                array_push($tag_blogs, $data->blogs);
            }
            $blog_data = Blog::where('title', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%')->where('active', 1)->get();
            $results = [];
            array_push($results, $blog_data);
            $results = array_unique(array_merge($results, $tag_blogs));
            return view('site.search.index', compact('search', 'results'));
        }catch(\Exception $ex){
            return redirect()->route('search.page');
        }

    }
}
