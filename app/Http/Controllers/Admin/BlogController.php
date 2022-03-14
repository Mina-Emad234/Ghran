<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Traits\GhranTrait;
use GuzzleHttp\ClientTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    use GhranTrait;
    public function index($cat_id='')
    {
        if (!empty($cat_id)){
            $blogs = Blog::with('category')->withCount(['comments','tags'=> function (Builder $query) {
                $query->where('active', 1);
            }])->where('category_id',$cat_id)->orderBy('id','desc')->paginate(10);
        }else {
            $blogs = Blog::with('category')->withCount(['comments','tags'=> function (Builder $query) {
                $query->where('active', 1);
            }])->orderBy('id','desc')->paginate(10);
        }
        return view('admin.blog.index',compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::get();
        $tags = Tag::where('active',1)->get();
        return view('admin.blog.create',compact('categories','tags'));
    }

    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $active = $this->checkActive($request);
            $file_name = $this->upload($request->image,'uploads/blogs');
            $add = Blog::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body,
                'slug' => str_replace(' ', '_', $request->title),
                'image' => $file_name,
                'active' => $active
            ]);
            $add->tags()->attach($request->tags);
            DB::commit();
            return redirect()->route('blog.index')->with(['success_msg' => 'تم إضافة منشور بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }
    public function show($id)
    {
        $blog = Blog::with('category')->find($id);
        if (!$blog)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        return view('admin.blog.show',compact('blog'));
    }
    public function edit($id)
    {
        $blog = $this->checkModel(new Blog,$id );
        $categories = BlogCategory::get();
        $tags = Tag::where('active',1)->get();
        return view('admin.blog.update',compact('blog','categories','tags'));
    }

    public function update($id,BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $blog = $this->checkModel(new Blog,$id );
            $active = $this->checkActive($request);
            $this->updateUpload($request,'image','uploads/blogs/',$blog->image,$blog);
                $data['category_id'] = $request->category_id;
                $data['title'] = $request->title;
                $data['body'] = $request->body;
                $data['slug'] = str_replace(' ', '_', $request->title);
                $data['active'] = $active;
                $blog->update($data);
                $blog->tags()->sync($request->tags);
                DB::commit();
                return redirect()->route('blog.index')->with(['success_msg' => 'تم تحديث المنشور بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $blog = $this->checkModel(new Blog,$id );
            $this->deleteWithImage('uploads/blogs/'.$blog->image,$blog);
                $blog->tags()->detach();
                DB::commit();
            return redirect()->route('blog.index')->with(['success_msg'=>'تم حذف المنشور بنجاح']);
        }catch (\Exception $e){
                DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
       return $this->modelActivation(new Blog,$id,1,'تم تفعيل المنشور بنجاح','blog.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Blog,$id,0,'تم إلغاء تفعيل المنشور بنجاح','blog.index');
    }
}
