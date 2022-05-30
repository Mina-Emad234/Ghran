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

class BlogsController extends Controller
{
    use GhranTrait;
    public function index()
    {
            $blogs = Blog::with('category')->withCount(['comments','tags'])->orderBy('id','desc')->paginate(10);
            return view('admin.blogs.index',compact('blogs'));
    }

    public function CategoryBlogs($slug){
        $category=BlogCategory::with('blogs')->where('slug',$slug)->first();
         $blogs=$category->blogs()->withCount(['comments','tags'])->orderByDesc('id')->paginate(10);
        return view('admin.blogs.index',compact('blogs','category'));
    }


    public function create()
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blogs.create',compact('categories','tags'));
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
                'slug' => str_replace(' ', '-', $request->title),
                'image' => $file_name,
                'active' => $active
            ]);
            $add->tags()->attach($request->tags);
            DB::commit();
            return redirect()->route('blogs.index')->with(['success_msg' => 'تم إضافة منشور بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }
    public function show(Blog $blog)
    {
        $blog->load('category');

        return view('admin.blogs.show',compact('blog'));
    }
    public function edit(Blog $blog)
    {
        $blog->load('tags');
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blogs.update',compact('blog','categories','tags'));
    }

    public function update(BlogRequest $request,Blog $blog)
    {
        try {
            DB::beginTransaction();
            $active = $this->checkActive($request);
            $this->updateUpload($request,'image','uploads/blogs/',$blog->image,$blog);
                $data['category_id'] = $request->category_id;
                $data['title'] = $request->title;
                $data['body'] = $request->body;
                $data['slug'] = str_replace(' ', '-', $request->title);
                $data['active'] = $active;
                $blog->update($data);
                $blog->tags()->sync($request->tags);
                DB::commit();
                return redirect()->route('blogs.index')->with(['success_msg' => 'تم تحديث المنشور بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function destroy(Blog $blog){
        try {
            DB::beginTransaction();
            $this->deleteWithImage('uploads/blogs/'.$blog->image,$blog);
                $blog->tags()->detach();
                DB::commit();
            return redirect()->route('blogs.index')->with(['success_msg'=>'تم حذف المنشور بنجاح']);
        }catch (\Exception $e){
                DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Blog $blog){
       return $this->modelActivation($blog,1,'تم تفعيل المنشور بنجاح','blogs.index');
    }

    public function deactivate(Blog $blog){
        return $this->modelActivation($blog,0,'تم إلغاء تفعيل المنشور بنجاح','blogs.index');
    }
}
