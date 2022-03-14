<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\Album;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class AlbumController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $albums = Album::paginate(5);
        return view('admin.album.index',compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(BlogCategoryRequest $request)
    {
        try {
            $file_name=$this->upload($request->image,'uploads/albums');
            Album::create([
                'name' => $request->name,
                'slug' => str_replace(' ', '_', $request->name),
                'image' => $file_name
            ]);
            return redirect()->route('album.index')->with(['success_msg' => 'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $album = $this->checkModel(new Album,$id);
        return view('admin.album.update',compact('album'));
    }

    public function update($id,BlogCategoryRequest $request)
    {
        try{
            $album = $this->checkModel(new Album,$id);
            $this->updateUpload($request,'image','uploads/albums',$album->image,$album);
            $data['name']=$request->name;
            $data['slug']=str_replace(' ','_',$request->name);
            $update = $album->update($data);
            return redirect()->route('album.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $album = $this->checkModel(new Album,$id);
            $this->deleteWithImage('uploads/albums/'.$album->image,$album);
            return redirect()->route('album.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
