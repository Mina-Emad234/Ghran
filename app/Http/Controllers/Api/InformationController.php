<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InformationRequest;
use App\Models\Info;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($infos as $info){
            unset($infos[$i]);
            $infos->push(array_merge($info->toArray(),['link'=>url('/api/information/'.$info->id)]));
            $i++;
        }
        return response($infos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InformationRequest $request)
    {
        try{
            $info = Info::create([
                'body'=>$request->body,
                'order'=>Info::max('order') + 1,
                'active'=>$request->active
            ]);
            return $info;
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
    public function show(Info $info)
    {
        return response($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformationRequest $request,Info $info)
    {
        try{
            if($request->has('id') && $request->id == $info->id) {

                $info->update($request->all());
                return response($info);
            }
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
    public function destroy(Info $info)
    {
        try{
            $info->delete();
            return response(['message'=>'تم حذف المعلومة بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
