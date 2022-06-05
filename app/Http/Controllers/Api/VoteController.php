<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AnswerRequest;
use App\Http\Requests\Api\VoteRequest;
use App\Models\VoteQuestion;
use App\Models\VoteResult;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = VoteQuestion::orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($votes as $vote){
            unset($votes[$i]);
            $votes->push(array_merge($vote->toArray(),['link'=>url('/api/vote_api/'.$vote->id)]));
            $i++;
        }
        return $votes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request)
    {
        try{
            $vote = VoteQuestion::create([
                'question'=>$request->question,
                'answer1'=>$request->answer1,
                'answer2'=>$request->answer2,
                'answer3'=>$request->answer3,
                'answer4'=>$request->answer4,
                'order'=>VoteQuestion::max('order') + 1,
                'active'=>$request->status
            ]);
            $last=VoteQuestion::latest()->first();
            if($last->status==1) {
                VoteQuestion::where('id','!=',$last->id)->update(['active'=>0]);
            }
            return response($vote);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VoteQuestion $vote)
    {
        $vote->load('answers')->loadCount('answers');
        if($vote->answers_count > 0) {
            return response([
                'question' => $vote->question,
                $vote->answer1 => VoteResult::where(['vote_question_id' => $vote->id, 'answer' => 1])->count() * 100 / $vote->answers_count . '%',
                $vote->answer2 => VoteResult::where(['vote_question_id' => $vote->id, 'answer' => 2])->count() * 100 / $vote->answers_count . '%',
                $vote->answer3 => VoteResult::where(['vote_question_id' => $vote->id, 'answer' => 3])->count() * 100 / $vote->answers_count . '%',
                $vote->answer4 => VoteResult::where(['vote_question_id' => $vote->id, 'answer' => 4])->count() * 100 / $vote->answers_count . '%',
            ]);
        }else{
            return response($vote);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request, VoteQuestion $vote)
    {
        try{
            if($request->has('id') && $request->id == $vote->id) {
                if ($request->has('active') && $request->status == 1) {
                    VoteQuestion::where('id', '!=', $vote->id)->update(['active' => 0]);
                }
                $vote->update($request->all());
            }
            return response($vote);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteQuestion $vote)
    {
        try{
            $vote->delete();
            return response(['message'=>'تم حذف إستفتاء بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function addAnswer(AnswerRequest $request,VoteQuestion $vote)
    {
        $vote->answers()->create([
            'vote_question_id'=>$request->$vote,
            'answer'=>$request->answer
        ]);
        return response('تم إضافة إجابة بنجاح');
    }
}
