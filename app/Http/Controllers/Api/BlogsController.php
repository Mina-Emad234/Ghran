<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogsRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;


class BlogsController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $blogs = Blog::with(['category', 'tags'])->whereIn('category_id',BlogCategory::pluck('id')->toArray())->paginate(10);
        return BlogResource::collection($blogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogsRequest $request)
    {
        try{
        DB::beginTransaction();
            $cat_name = BlogCategory::find($request->category_id)->name;
            $file_name = $this->upload($request->image,'uploads/blogs/'.$cat_name);
            $blog = Blog::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => str_replace(' ', '-', $request->title),
            'image' => $file_name,
            'status' => $request->status,
        ]);
            $tags=explode(',',implode(',',$request->tags));
            $blog->tags()->attach($tags);
        DB::commit();
        return $blog;
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->load('category:id,name', 'tags:id,name','comments._child');
        if(!$blog->category)
            return response('حدت خطأ ما');
        return response($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogsRequest $request, Blog $blog)
    {
        try{
            if($request->has('id') && $request->id == $blog->id) {
                DB::beginTransaction();
                $data = $request->except('image');
                $blog->load('category');
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
                if ($request->has('title')) {
                    $data['slug'] = str_replace(' ', '-', $request->title);
                }
                $blog->update($data);
                if ($request->has('tags')) {
                    $tags = explode(',', implode(',', $request->tags));
                    $blog->tags()->attach($tags);
                }
                DB::commit();
                return response($blog);
            }
            }catch (Exception $ex){
                return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try{
            $blog->load('category','tags');
            $blog->tags()->detach();
            $this->deleteWithImage('uploads/blogs/'.$blog->category->name.'/'.$blog->image,$blog);
            return response(['message'=>'تم حذف المنشور بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
