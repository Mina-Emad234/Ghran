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

class VoteQuestionController extends Controller
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
                'active'=>$active
            ]);
            $id=VoteQuestion::latest()->first()->id;
            if($active) {
                VoteQuestion::where('id','!=',$id)->update(['active'=>0]);
            }
            return redirect()->route('v_question.index')->with(['success_msg'=>'تم إضافة الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $vote = $this->checkModel(new VoteQuestion,$id);
        return view('admin.vote.update',compact('vote'));
    }

    public function update($id,VoteQuestionRequest $request)
    {
        try{
            $vote = $this->checkModel(new VoteQuestion,$id);
            $active = $this->checkActive($request);
            if($active) {
                VoteQuestion::where('id','!=',$id)->update(['active'=>0]);
            }
            $data['question']=$request->question;
            $data['answer1']=$request->answer1;
            $data['answer2']=$request->answer2;
            $data['answer3']=$request->answer3;
            $data['answer4']=$request->answer4;
            $data['active'] = $active;
            $update = $vote->update($data);

            return redirect()->route('v_question.index')->with(['success_msg'=>'تم تحديث الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $vote = $this->checkModel(new VoteQuestion,$id);
            $delete = $vote->delete();

            return redirect()->route('v_question.index')->with(['success_msg'=>'تم حذف الإستفتاء بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        $vote = $this->checkModel(new VoteQuestion,$id);

        VoteQuestion::where('id','!=',$id)->update(['active'=>0]);
        $activate = $vote->update(['active'=>1]);

        return redirect()->route('v_question.index')->with(['success_msg'=>'تم تفعيل الإستفتاء بنجاح']);
    }

    public function deactivate($id){
        return $this->modelActivation(new VoteQuestion,$id,0,'تم إلغاء تفعيل الإستفتاء بنجاح','v_question.index');
    }

    public function sort($direction = 'up', $id = '')
    {
        $vote = $this->checkModel(new VoteQuestion,$id);
        return $this->sortData(new VoteQuestion,'v_question.index',$direction,$id);

    }

    public function result($question_id=''){
        $vote = VoteQuestion::withCount('answers')->whereId($question_id)->first();
        return view('admin.vote.result',compact('vote'));
    }
}
