<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VolunteersRequest;
use App\Models\Team;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use Symfony\Component\Intl\Countries;

class VolunteersController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers = Team::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($volunteers as $volunteer){
            unset($volunteers[$i]);
            $volunteers->push(array_merge($volunteer->toArray(),['link'=>url('/api/volunteers/'.$volunteer->id)]));
            $i++;
        }
        return $volunteers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VolunteersRequest $request)
    {
        try{
            $file_name = $this->upload($request->image,'uploads/volunteers');
            $volunteer=Team::create([
                'name'=>$request->name,
                'nationality'=>$request->nationality,
                'gender'=>$request->gender,
                'city'=>$request->city,
                'age'=>$request->age,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'marital_status'=>$request->marital_status,
                'email'=>$request->email,
                'qualification'=>$request->qualification,
                'major'=>$request->major,
                'job'=>$request->job,
                'skills'=>$request->skills,
                'voluntary'=>$request->voluntary,
                'favor_time'=> implode(', ',$request->favor_time),
                'parent_name'=>$request->parent_name,
                'parent_email'=>$request->parent_email,
                'parent_mobile'=>$request->parent_mobile,
                'parent_tel'=>$request->parent_tel,
                'image'=>$file_name,
                'parent_job'=>$request->parent_job,
                'fav_days'=>implode(', ',$request->fav_days),
            ]);
            return response($volunteer);
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
    public function show(Team $volunteer)
    {
        return response($volunteer);
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
    public function destroy(Team $volunteer)
    {
        try{
            $this->deleteWithImage('uploads/volunteers/'.$volunteer->image,$volunteer);
            return response(['message'=>'تم حذف عضو الكشافة بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
