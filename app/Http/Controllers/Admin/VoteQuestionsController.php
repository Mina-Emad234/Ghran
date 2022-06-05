<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VoteQuestionRequest;
use App\Models\VoteQuestion;
use App\Models\VoteResult;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class VoteQuestionsController extends Controller
{
    use GhranTrait;
    public function index()
    {

        $votes = VoteQuestion::orderBy('order','asc')->paginate(10);
        return view('admin.vote.index',compact('votes'));
    }

    public function create()
    {
        return view('admin.vote.create');
    }

    public function store(VoteQuestionRequest $request)
    {
        try{
            $active = $this->checkActive($request);

            $add = VoteQuestion::create([
                'question'=>$request->question,
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'order'=>VoteQuestion::max('order') + 1,
                'status'=>$active
            ]);
            $id=VoteQuestion::latest()->first()->id;
            if($active) {
                VoteQuestion::where('id','!=',$id)->update(['status'=>0]);
            }
            return redirect()->route('questions.index')->with(['success_msg'=>'تم إضافة الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit(VoteQuestion $question)
    {
        return view('admin.vote.update',compact('question'));
    }

    public function update(VoteQuestionRequest $request,VoteQuestion $question)
    {
        try{
            $active = $this->checkActive($request);
            if($active) {
                VoteQuestion::where('id','!=',$question->id)->update(['status'=>0]);
            }
            $data['question']=$request->question;
            $data['answer1']=$request->answer1;
            $data['answer2']=$request->answer2;
            $data['answer3']=$request->answer3;
            $data['answer4']=$request->answer4;
            $data['status'] = $active;
            $update = $question->update($data);

            return redirect()->route('questions.index')->with(['success_msg'=>'تم تحديث الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(VoteQuestion $question){
        try{
            $delete = $question->delete();

            return redirect()->route('questions.index')->with(['success_msg'=>'تم حذف الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(VoteQuestion $vote){
        VoteQuestion::where('id','!=',$vote->id)->update(['status'=>0]);
        $activate = $vote->update(['status'=>1]);

        return redirect()->route('questions.index')->with(['success_msg'=>'تم تفعيل الإستفتاء بنجاح']);
    }

    public function deactivate(VoteQuestion $vote){
        return $this->modelActivation($vote,0,'تم إلغاء تفعيل الإستفتاء بنجاح','questions.index');
    }

    public function sort(VoteQuestion $vote,$direction = 'up')
    {
        return $this->sortData($vote,'questions.index',$direction);

    }

    public function result($question_id=''){
        $vote = VoteQuestion::withCount('answers')->whereId($question_id)->first();
        $answer1=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>1])->count();
        $answer2=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>2])->count();
        $answer3=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>3])->count();
        $answer4=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>4])->count();
        return view('admin.vote.result',compact('vote','answer1','answer2','answer3','answer4'));
    }

}
