<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogsRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $blogs = Blog::with('category','tags')->paginate(10);
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
        $file_name = $this->upload($request->image,'uploads/blogs');
        $blog = Blog::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => str_replace(' ', '-', $request->title),
            'image' => $file_name,
            'active' => $request->active,
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
                $this->updateUpload($request, "image", 'uploads/blogs', $blog->image, $blog);
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
            $this->deleteWithImage('uploads/blogs/'.$blog->image,$blog);
            return response(['message'=>'تم حذف المنشور بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
