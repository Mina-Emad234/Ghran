<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class BlogCategoriesController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $categories = BlogCategory::withTrashed()->orderByDesc('id')->paginate(5);
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(BlogCategoryRequest $request)
    {
        try {
            $file_name=$this->upload($request->image,'uploads/categories');
            BlogCategory::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','-',$request->name),
                'image'=>$file_name
            ]);
            if(!File::isDirectory(public_path('uploads/blogs/'.$request->name))) {
                File::makeDirectory(public_path('uploads/blogs/' . $request->name));
            }
            return redirect()->route('categories.index')->with(['success_msg'=>'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function edit(BlogCategory $category)
    {
        return view('admin.categories.update',compact('category'));
    }

    public function update(BlogCategoryRequest $request,BlogCategory $category)
    {
        try {
             $this->updateUpload($request,"image",'uploads/categories',$category->image,$category);
                $data['name']=$request->name;
                $data['slug']=str_replace(' ','-',$request->name);
            if(File::isDirectory(public_path('uploads/blogs/'.$category->name))) {
                rename(public_path('uploads/blogs/' . $category->name), public_path('uploads/blogs/' . $request->name));
            }
            $update = $category->update($data);
            return redirect()->route('categories.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(BlogCategory $category){
        try {
            $category->delete();
            return redirect()->route('categories.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function restore($id){
        try {
            BlogCategory::withTrashed()->findOrFail($id)->restore();
            return redirect()->route('categories.index')->with(['success_msg'=>'تم إسترجاع القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
