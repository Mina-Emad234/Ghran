<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageCategoryRequest ;
use App\Models\Album;
use App\Models\Blog;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class AlbumsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $albums = Album::orderByDesc('id')->paginate(5);
        return view('admin.albums.index',compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(ImageCategoryRequest $request)
    {
        try {
            $file_name=$this->upload($request->image,'uploads/albums');
            $active = $this->checkActive($request);
            Album::create([
                'name' => $request->name,
                'slug' => str_replace(' ', '-', $request->name),
                'image' => $file_name,
                'status'=>$active
            ]);
            if(!File::isDirectory(public_path('uploads/photos/'.$request->name))) {
                File::makeDirectory(public_path('uploads/photos/' . $request->name));
            }
            return redirect()->route('albums.index')->with(['success_msg' => 'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit(Album $album)
    {
        return view('admin.albums.update',compact('album'));
    }

    public function update(ImageCategoryRequest $request,Album $album)
    {
        try{
            $this->updateUpload($request,'image','uploads/albums',$album->image,$album);
            $active = $this->checkActive($request);
            $data['name']=$request->name;
            $data['slug']=str_replace(' ','-',$request->name);
            $data['status'] = $active;
            if(File::isDirectory(public_path('uploads/photos/'.$album->name))) {
                rename(public_path('uploads/photos/' . $album->name), public_path('uploads/photos/' . $request->name));
            }
            $update = $album->update($data);
            return redirect()->route('albums.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Album $album){
        try{

            $album->load('photos');
            foreach($album->photos as $photo){
                unlink(public_path('uploads/photos/'.$album->name.'/'.$photo->photo));
            }
            File::deleteDirectory(public_path('uploads/photos/'.$album->name));

            $this->deleteWithImage('uploads/albums/'.$album->image,$album);
            return redirect()->route('albums.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
    public function activate(Album $album){
        return $this->modelActivation($album,1,'تم تفعيل ألبوم صور بنجاح','albums.index');
    }

    public function deactivate(Album $album){
        return $this->modelActivation($album,0,'تم إلغاء تفعيل ألبوم صور بنجاح','albums.index');
    }
}
