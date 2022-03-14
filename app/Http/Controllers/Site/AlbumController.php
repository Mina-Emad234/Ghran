<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::get();
       return view('site.album.index',compact('albums'));
    }
    public function photos($id)
    {
        $photos = Album::with(['photos'=>function($query){
            $query->where('active',1);
        }])->find($id);
        return view('site.album.photos',compact('photos'));
    }
}
