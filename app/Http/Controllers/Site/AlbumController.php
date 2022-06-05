<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
         $albums = Album::where('status',1)->orderByDesc('id')->get();
       return view('site.album.index',compact('albums'));
    }
    public function photos($slug)
    {
            $photos = Album::with(['photos' => function ($query) {
                $query->where('status', 1);
            }])->where(['slug' => $slug, 'status' => 1])->first();
            if(!$photos)
                return abort('404');
            return view('site.album.photos', compact('photos'));
    }
}
