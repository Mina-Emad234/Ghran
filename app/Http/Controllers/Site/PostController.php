<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CommentRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PostController extends Controller
{
    public function index($slug=''){
        if(empty($slug)) {
            $blogs = Blog::where('active', 1)->latest()->limit(25)->get();
            return view('site.blog.blog_index',compact('blogs'));
        }else{
            $category = BlogCategory::with(['blogs'=>function($query){
                $query->where('active', 1)->latest()->limit(25);
            }])->where('slug',$slug)->first();
            return view('site.blog.blog_index',compact('category'));
        }
    }

    public function show($slug){
        $blog = Blog::with(['category','tags','comments'=>function ($query) {
        $query->where(['active'=> 1,'parent_id'=>null]);
        },'comments._child'=>function ($query) {
            $query->where('active', 1);
        }])->withCount(['comments'=>function ($query){
            $query->where('active',1);
        }])->where(['active'=>1,'slug'=>$slug])->first();
        if(!$blog)
            return redirect()->back();
        return view('site.blog.show',compact('blog'));
    }

    public function getBlogTag($slug){
        $tag_data = Tag::with(['blogs'=>function($query){
            $query->where('active',1);
        }])->where('slug',$slug)->first();
        return view('site.blog.blog_tag',compact('tag_data'));
    }

    public function addComment($slug,CommentRequest $request){
        try {
            $blog = Blog::where('slug',$slug)->first();
            if(!$blog)
                return redirect()->back()->withInput()->with(['error'=>'حدث خطأ ما حاول مرة أخرى']);

            if($request->has('parent_id')){
                $parent=$request->parent_id;
            }else{
                $parent=null;
            }

            Comment::create([
                'writer'=>$request->writer,
                'email'=>$request->email,
                'body'=>$request->body,
                'parent_id'=>$parent,
                'blog_id'=>$request->blog_id,
            ]);
            setcookie('comment_writer',$request->writer,2147483647,'/');
            setcookie('comment_email',$request->email,2147483647,'/');
            return redirect()->route('post.show',$slug)->with(['success'=>'تم إضافة تعليق بنجاح في إنتظار التفعيل من قبل المسؤل']);
        }catch (Exception $r){
            return redirect()->back()->withInput()->with(['error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

    public function EditComment($slug,CommentRequest $request){
        try {
            $blog = Blog::where('slug',$slug)->first();
            $comment=Comment::where(['writer'=>$_COOKIE['comment_writer'],'email'=>$_COOKIE['comment_email']])->find($request->id);
            if(!$blog || !$comment)
                return redirect()->back()->withInput()->with(['error'=>'حدث خطأ ما حاول مرة أخرى']);

            if($request->has('parent_id')){
                $parent=$request->parent_id;
            }else{
                $parent=null;
            }

            $comment->update([
                'writer'=>$request->writer,
                'email'=>$request->email,
                'body'=>$request->body,
                'parent_id'=>$parent,
                'blog_id'=>$request->blog_id,
            ]);

            return redirect()->route('post.show',$slug)->with(['success'=>'تم تحديث تعليق بنجاح ']);
        }catch (Exception $r){
            return redirect()->back()->withInput()->with(['error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

    public function deleteComment($id){
        try{
            $comment = Comment::find($id);
            if(!$comment)
                return redirect()->back()->withInput()->with(['error_msg'=>'حدث خطأ ما حاول مرة أخرى']);
                $comment->delete();
            return redirect()->back()->with(['success'=>'تم حذف تعليق بنجاح']);
        }catch (Exception $r){
            return redirect()->back()->withInput()->with(['error_msg'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }
}