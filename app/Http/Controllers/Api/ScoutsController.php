<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ScoutsRequest;
use App\Models\Scout;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ScoutsController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scouts = Scout::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($scouts as $scout){
            unset($scouts[$i]);
            $scouts->push(array_merge($scout->toArray(),['link'=>url('/api/scouts_api/'.$scout->id)]));
            $i++;
        }
        return $scouts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScoutsRequest $request)
    {
        try{
            $file_name = $this->upload($request->image,'uploads/scouts');
            $scout=Scout::create([
                'name'=>$request->name,
                'school'=>$request->school,
                'grade'=>$request->grade,
                'interests'=>$request->interests,
                'age'=>$request->age,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'email'=>$request->email,
                'parent_name'=>$request->parent_name,
                'parent_email'=>$request->parent_email,
                'parent_mobile'=>$request->parent_mobile,
                'parent_tel'=>$request->parent_tel,
                'image'=>$file_name,
                'parent_job'=>$request->parent_job,
            ]);
            return response($scout);
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
    public function show(Scout $scout)
    {
        return response($scout);
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
    public function destroy(Scout $scout)
    {
        try{
            $this->deleteWithImage('uploads/scouts/'.$scout->image,$scout);
            return response(['message'=>'تم حذف عضو الكشافة بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
