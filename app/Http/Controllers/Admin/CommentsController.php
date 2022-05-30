<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CommentsController extends Controller
{
    use GhranTrait;
    public function index($slug='')
    {
        if (!empty($slug)){
            $blog = Blog::with('comments')->where('slug',$slug)->first();
              $comments=$blog->comments()->orderBy('id','desc')->paginate(10);

            return view('admin.comments.index',compact('comments','blog'));
        }else {
            $comments = Comment::with('blog')->orderBy('id','desc')->paginate(10);
            return view('admin.comments.index',compact('comments'));

        }
    }

    public function delete(Comment $comment){
        try{
            $delete = $comment->delete();
            return redirect()->route('comments.index')->with(['success_msg'=>'تم حذف التعليق بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Comment $comment){
        return $this->modelActivation($comment,1,'تم تفعيل التعليق بنجاح','comments.index');
    }

    public function deactivate(Comment $comment){
        return $this->modelActivation($comment,0,'تم إلغاء تفعيل التعليق بنجاح','comments.index');
    }
}
