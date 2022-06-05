<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VoteRequest;
use App\Models\VoteQuestion;
use App\Models\VoteResult;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    public function votePrevious(){
        $votes = VoteQuestion::all();
        return view('site.vote.previous_votes',compact('votes'));
    }

    public function voteAnswer($id,VoteRequest $request){
        try {
            $vote = VoteQuestion::where('status',1)->find($id);
            if(!$vote || !in_array($request->answer,['1','2','3','4']))
                return redirect()->back()->withInput()->with(['vote_error'=>'حدث خطأ ما حاول مرة أخرى']);

            VoteResult::create([
                'vote_question_id'=>$id,
                'answer'=>(int)$request->answer
            ]);
            setcookie('vote_id',$id,2147483647,'/');
            return redirect()->back()->with(['vote_success'=>'تم التصويت بنجاح']);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with(['vote_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }
    public function voteResult($question_id=''){

            $vote = VoteQuestion::withCount('answers')->whereId($question_id)->first();

        $answer1=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>1])->count();
        $answer2=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>2])->count();
        $answer3=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>3])->count();
        $answer4=VoteResult::where(['vote_question_id'=>$vote->id,'answer'=>4])->count();
        return view('site.vote.result',compact('vote','answer1','answer2','answer3','answer4'));
    }
}
