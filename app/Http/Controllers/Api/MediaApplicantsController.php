<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaApplicantsRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class MediaApplicantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $media_applicants = Media::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($media_applicants as $media_applicant){
            unset($media_applicants[$i]);
            $media_applicants->push(array_merge($media_applicant->toArray(),['link'=>url('/api/media/applicants/'.$media_applicant->id)]));
            $i++;
        }
        return $media_applicants;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaApplicantsRequest $request)
    {
        try{
            $applicant= Media::create([
                'name'=>$request->name,
                'identity'=>$request->identity,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'course'=>$request->course,
            ]);
            return response($applicant);
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
    public function show(Media $applicant)
    {
        return response($applicant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $applicant)
    {
        try{
            $applicant->delete();
            return response(['message'=>'تم حذف بيانات متقدم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
