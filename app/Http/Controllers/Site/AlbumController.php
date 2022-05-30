<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::orderByDesc('id')->get();
       return view('site.album.index',compact('albums'));
    }
    public function photos($slug)
    {
        $photos = Album::with(['photos'=>function($query){
            $query->where('active',1);
        }])->where('slug',$slug)->first();
        return view('site.album.photos',compact('photos'));
    }
}
