<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PhotoRequest;
use App\Models\Album;
use App\Models\Photo;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PhotosController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $photos = Photo::with('album')->orderBy('id','desc')->paginate(10);
        return view('admin.photos.index',compact('photos'));
    }

    public function getAlbumPhotos($slug)
    {
            $album = Album::with('photos')->where('slug',$slug)->first();
        $photos = $album->photos()->orderByDesc('id')->paginate(10);
        return view('admin.photos.index',compact('photos','album'));
    }

    public function create()
    {
        $albums=Album::all();
        return view('admin.photos.create',compact('albums'));
    }

    public function store(PhotoRequest $request)
    {
        try{
            foreach($request->photos as $photo)
            {
                $folder = 'uploads/photos';
                $file_extension= $photo->getClientOriginalExtension();
                $file_name=random_int(100000,1000000000).'.'.$file_extension;
                $photo->move($folder,$file_name);
                $insert['photo'] = $file_name;
                $insert['album_id'] = $request->album_id;
                $insert['active'] = 1;
                $insert['order'] = Photo::max('order')+1;
                Photo::create($insert);
            }
            return redirect()->route('photos.index')->with(['success_msg'=>'تم إضافة صورة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Photo $photo){
        try{
            $this->deleteWithImage('uploads/photos/'.$photo->photo,$photo);
            return redirect()->route('photos.index')->with(['success_msg'=>'تم حذف الصورة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Photo $photo){
        return $this->modelActivation($photo,1,'تم تفعيل الصورة بنجاح','photos.index');
    }

    public function deactivate(Photo $photo){
        return $this->modelActivation($photo,0,'تم إلغاء تفعيل الصورة بنجاح','photos.index');
    }
}
