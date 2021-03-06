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
use Illuminate\Support\Facades\File;

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
        if(!$category)
            return abort('404');
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
            $cat_name = BlogCategory::find($request->category_id)->name;
            $file_name = $this->upload($request->image,'uploads/blogs/'.$cat_name);
            $add = Blog::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body,
                'slug' => str_replace(' ', '-', $request->title),
                'image' => $file_name,
                'status' => $active
            ]);
            $add->tags()->attach($request->tags);
            DB::commit();
            return redirect()->route('blogs.index')->with(['success_msg' => '???? ?????????? ?????????? ??????????']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }

    }
    public function show(Blog $blog)
    {
        $blog->load('category');
        if(!$blog->category)
            return abort('404');

        return view('admin.blogs.show',compact('blog'));
    }
    public function edit(Blog $blog)
    {
        $blog->load('tags','category');
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blogs.update',compact('blog','categories','tags'));
    }

    public function update(BlogRequest $request,Blog $blog)
    {
        try {
            DB::beginTransaction();
            $blog->load('category');
            $active = $this->checkActive($request);
            if($blog->category->id == $request->category_id){
                $this->updateUpload($request,'image','uploads/blogs/'. $blog->category->name.'/',$blog->image,$blog);
            }else{
                $cat_name = BlogCategory::find($request->category_id)->name;
                if($request->has('image')) {
                    if (file_exists('uploads/blogs/' . $blog->category->name . '/' . $blog->image) && $blog->image != '') {
                        unlink('uploads/blogs/' . $blog->category->name . '/' . $blog->image);
                        $file_name = $this->upload($request->image, 'uploads/blogs/' . $cat_name);
                        $data['image'] = $file_name;
                    }
                }else{
                    File::move('uploads/blogs/' . $blog->category->name . '/' . $blog->image,'uploads/blogs/' .$cat_name.'/'.$blog->image);
                }
            }
            $this->updateUpload($request,'image','uploads/blogs/',$blog->image,$blog);
                $data['category_id'] = $request->category_id;
                $data['title'] = $request->title;
                $data['body'] = $request->body;
                $data['slug'] = str_replace(' ', '-', $request->title);
                $data['status'] = $active;
                $blog->update($data);
                $blog->tags()->sync($request->tags);
                DB::commit();
                return redirect()->route('blogs.index')->with(['success_msg' => '???? ?????????? ?????????????? ??????????']);
        }catch (\Exception $e){
            DB::rollBack();
            return $e;
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }

    }

    public function destroy(Blog $blog){
        try {
            DB::beginTransaction();
            $blog->load('category');
            $this->deleteWithImage('uploads/blogs/'.$blog->category->name.'/'.$blog->image,$blog);

            $this->deleteWithImage('uploads/blogs/'.$blog->image,$blog);
                $blog->tags()->detach();
                DB::commit();
            return redirect()->route('blogs.index')->with(['success_msg'=>'???? ?????? ?????????????? ??????????']);
        }catch (\Exception $e){
                DB::rollBack();
            return redirect()->back()->with(['error_msg' => '???????? ?????????? ???? ???? ???????? ???????? ?????? ????????']);
        }
    }

    public function activate(Blog $blog){
       return $this->modelActivation($blog,1,'???? ?????????? ?????????????? ??????????','blogs.index');
    }

    public function deactivate(Blog $blog){
        return $this->modelActivation($blog,0,'???? ?????????? ?????????? ?????????????? ??????????','blogs.index');
    }
}
