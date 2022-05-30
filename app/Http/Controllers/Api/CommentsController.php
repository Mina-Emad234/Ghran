<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentsRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with('_child','blog:id,title')->where('parent_id',NULL)->paginate(10);
        $i=0;
        foreach ($comments as $comment){
            unset($comments[$i]);
            $comments->push(array_merge($comment->toArray(),['link'=>url('/api/comments/'.$comment->id)]));
            $i++;
        }
        return $comments;
    }

    public function show(Comment $comment)
    {
        $comment->load('_child');
        return $comment;
    }

    public function activation(Comment $comment)
    {
        if($comment->_parent()->exists() && $comment->load('_parent')->active == 0){
            return ['parent_comment'=>$comment->_parent,'error_message'=>'يجب تفعيل التعليق الرئيسي أولا'];
        }elseif($comment->active == 0){
            $comment->update(['active'=>1]);
            return ['message'=>'تم تفعيل التعليق بنجاح'];
        }else{
            $comment->update(['active'=>0]);
            return ['message'=>'تم إلغاء تفعيل التعليق بنجاح'];
        }
    }
    public function store(CommentsRequest $request)
    {
        try{
            if($request->has('parent_id')){
                $parent = $request->parent_id;
            }else{
                $parent=NULL;
            }
            $comment=Comment::create([
                'writer'=>$request->writer,
                'email'=>$request->email,
                'body'=>$request->body,
                'parent_id'=>$parent,
                'blog_id'=>$request->blog_id,
            ]);
            return $comment;
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function update(CommentsRequest $request,Comment $comment)
    {
        try{
            if($request->has('id') && $request->id == $comment->id) {

                $comment->update($request->except('active', 'blog_id', 'parent_id'));
                return $comment;
            }
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function destroy(Comment $comment)
    {
        try{
            $comment->delete();
            return response(['message'=>'تم حذف تعليق بنجاح']);
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
