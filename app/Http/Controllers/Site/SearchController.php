<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VoteRequest;
use App\Http\Requests\Site\SearchRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\ViewSearchData;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPage(){
        return view('site.search.index');
    }
    public function search(Request $request){
        try {
            $search = $request->search;
            if($search!=""){
            $search_data = ViewSearchData::where('title', 'like', '%' . $search . '%')->orWhere('body', 'like', '%' . $search . '%')->paginate(10);
                $search_data->appends(['search' => $search]);
            }
            return view('site.search.index', compact('search', 'search_data'));

        }catch(\Exception $ex){
            return redirect()->route('search.page');
        }

    }
}
