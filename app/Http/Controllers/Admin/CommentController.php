<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CommentController extends Controller
{
    use GhranTrait;
    public function index($blog_id='')
    {
        if (!empty($blog_id)){
            $comments = Comment::with('blog')->orderBy('id','desc')->where('blog_id',$blog_id)->paginate(10);
        }else {
            $comments = Comment::with('blog')->orderBy('id','desc')->paginate(10);
        }
        return view('admin.comment.index',compact('comments'));
    }

    public function delete($id){
        try{
            $comment = $this->checkModel(new Comment,$id);
            $delete = $comment->delete();
            return redirect()->route('comment.index')->with(['success_msg'=>'تم حذف التعليق بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new Comment,$id,1,'تم تفعيل التعليق بنجاح','comment.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Comment,$id,0,'تم إلغاء تفعيل التعليق بنجاح','comment.index');
    }
}
