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

class TagsController extends Controller
{
    use GhranTrait;
    public function index()
    {

            $tags = Tag::orderBy('order','desc')->paginate(10);

        return view('admin.tags.index',compact('tags'));
    }

    public function getBlogTags($slug)
    {

        $blog = Blog::with('tags')->where('slug',$slug)->first();
        $tags=$blog->tags()->orderByDesc('order')->paginate(10);

        return view('admin.tags.index',compact('tags','blog'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        try{
            $active = $this->checkActive($request);

            $add = tag::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','-',$request->name),
                'order'=>tag::max('order') + 1,
                'status'=>$active
            ]);

            return redirect()->route('tags.index')->with(['success_msg'=>'تم إضافة كلمة البحت بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.update',compact('tag'));
    }

    public function update(TagRequest $request,Tag $tag)
    {
        try{
            $active = $this->checkActive($request);

            $data['name']=$request->name;
            $data['slug']=str_replace(' ','-',$request->name);
            $data['status']=$active;
            $update = $tag->update($data);

            return redirect()->route('tags.index')->with(['success_msg'=>'تم تحديث كلمة البحث بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Tag $tag){
        try{
            $delete = $tag->delete();

            return redirect()->route('tags.index')->with(['success_msg'=>'تم حذف كلمة البحث بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Tag $tag){
        return $this->modelActivation($tag,1,'تم تفعيل كلمة البحث بنجاح','tags.index');
    }

    public function deactivate(Tag $tag){
        return $this->modelActivation($tag,0,'تم إلغاء تفعيل كلمة البحث بنجاح','tags.index');
    }


}
