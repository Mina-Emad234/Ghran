<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class BlogCategoryController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $categories = BlogCategory::paginate(5);
        return view('admin.blog_category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function store(BlogCategoryRequest $request)
    {
        try {
            $file_name=$this->upload($request->image,'uploads/categories');
            BlogCategory::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','_',$request->name),
                'image'=>$file_name
            ]);
            return redirect()->route('category.index')->with(['success_msg'=>'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function edit($id)
    {
        $category = $this->checkModel(new BlogCategory,$id);
        return view('admin.blog_category.update',compact('category'));
    }

    public function update($id,BlogCategoryRequest $request)
    {
        try {
            $category = $this->checkModel(new BlogCategory,$id);
             $this->updateUpload($request,"image",'uploads/categories',$category->image,$category);
                $data['name']=$request->name;
                $data['slug']=str_replace(' ','_',$request->name);
                $update = $category->update($data);
            return redirect()->route('category.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try {
            $category = $this->checkModel(new BlogCategory,$id);
            $this->deleteWithImage('uploads/categories/'.$category->image,$category);
            return redirect()->route('category.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
