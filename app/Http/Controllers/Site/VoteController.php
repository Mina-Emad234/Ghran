<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VoteRequest;
use App\Models\VoteQuestion;
use App\Models\VoteResult;
use Illuminate\Http\Request;

class VoteController extends Controller
{
//    public function voteResult(){
//
//    }

    public function votePrevious(){
        $votes = VoteQuestion::get();
        return view('site.vote.previous_votes',compact('votes'));
    }

    public function voteAnswer($id,VoteRequest $request){
        try {
            $vote = VoteQuestion::where('active',1)->find($id);
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
        return view('site.vote.result',compact('vote'));
    }
}
