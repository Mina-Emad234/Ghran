<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class TagController extends Controller
{
    use GhranTrait;
    public function index()
    {

            $tags = Tag::orderBy('order','asc')->paginate(10);

        return view('admin.tag.index',compact('tags'));
    }

    public function getBlogTags($blog_id)
    {

            $tags = Blog::find($blog_id)->tags()->orderBy('order')->paginate(10);

        return view('admin.tag.index',compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(TagRequest $request)
    {
        try{
            $active = $this->checkActive($request);

            $add = tag::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','_',$request->name),
                'order'=>tag::max('order') + 1,
                'active'=>$active
            ]);

            return redirect()->route('tag.index')->with(['success_msg'=>'تم إضافة كلمة البحت بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $tag = $this->checkModel(new Tag,$id);
        return view('admin.tag.update',compact('tag'));
    }

    public function update($id,TagRequest $request)
    {
        try{
            $tag = $this->checkModel(new Tag,$id);
            $active = $this->checkActive($request);

            $data['name']=$request->name;
            $data['slug']=str_replace(' ','_',$request->name);
            $data['active']=$active;
            $update = $tag->update($data);

            return redirect()->route('tag.index')->with(['success_msg'=>'تم تحديث كلمة البحث بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $tag = $this->checkModel(new Tag,$id);
            $delete = $tag->delete();

            return redirect()->route('tag.index')->with(['success_msg'=>'تم حذف كلمة البحث بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new tag,$id,1,'تم تفعيل كلمة البحث بنجاح','tag.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new tag,$id,0,'تم إلغاء تفعيل كلمة البحث بنجاح','tag.index');
    }

    public function sort($direction = 'up', $id = '')
    {
        $tag = $this->checkModel(new Tag,$id);
        return $this->sortData(new Tag,'tag.index',$direction,$id);
    }

}
