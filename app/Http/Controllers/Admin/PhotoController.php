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

class PhotoController extends Controller
{
    use GhranTrait;
    public function index()
    {

            $photos = Photo::with('album')->orderBy('order','asc')->paginate(10);
        return view('admin.photo.index',compact('photos'));
    }

    public function getAlbumPhotos($album_id)
    {
            $photos = Photo::with('album')->where('album_id',$album_id)->orderBy('order','asc')->paginate(10);
        return view('admin.photo.index',compact('photos'));
    }

    public function create()
    {
        $albums=Album::get();
        return view('admin.photo.create',compact('albums'));
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
            return redirect()->route('photo.index')->with(['success_msg'=>'تم إضافة صورة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $photo = $this->checkModel(new Photo,$id);
            $this->deleteWithImage('uploads/photos/'.$photo->photo,$photo);
            return redirect()->route('photo.index')->with(['success_msg'=>'تم حذف الصورة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new Photo,$id,1,'تم تفعيل الصورة بنجاح','photo.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Photo,$id,0,'تم إلغاء تفعيل الصورة بنجاح','photo.index');
    }
    public function sort($direction = 'up', $id = '')
    {
        $photo = $this->checkModel(new Photo,$id);
        return $this->sortData(new Photo,'photo.index',$direction,$id);
    }

}
