<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogCategoriesRequest;
use App\Models\BlogCategory;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class BlogCategoriesController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::withTrashed()->orderByDesc('id')->paginate(5);
        $i=0;
        foreach ($categories as $category){
            unset($categories[$i]);
            $categories->push(array_merge($category->toArray(),['link'=>url('/api/blog_categories_api/'.$category->id)]));
            $i++;
        }

        return response($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoriesRequest $request)
    {
        try{
            $file_name=$this->upload($request->image,'uploads/categories');
            $category = BlogCategory::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','-',$request->name),
                'image'=>$file_name
            ]);
            if(!File::isDirectory(public_path('uploads/blogs/'.$request->name))) {
                File::makeDirectory(public_path('uploads/blogs/' . $request->name));
            }
            return $category;
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
    public function show($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->load('blogs:id,category_id,title');
        return response($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoriesRequest $request, $id)
    {
        try{
            $category = BlogCategory::findOrFail($id);

            if($request->has('id') && $request->id == $category->id) {

                $data = $request->except('image');
                $this->updateUpload($request, "image", 'uploads/categories', $category->image, $category);
                if ($request->has('name')) {
                    $data['slug'] = str_replace(' ', '-', $request->name);
                }
                if(File::isDirectory(public_path('uploads/blogs/'.$category->name))) {
                    rename(public_path('uploads/blogs/' . $category->name), public_path('uploads/blogs/' . $request->name));
                }
                $category->update($data);

                return response($category);
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
    public function destroy($id)
    {
        try{
            BlogCategory::findOrFail($id)->delete();
            return response(['message'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function restore($id)
    {
        try{
            BlogCategory::withTrashed()->findOrFail($id)->restore();
            return response(['message'=>'تم إسترجاع القسم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
