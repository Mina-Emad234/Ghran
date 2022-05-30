<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PhotosRequest;
use App\Models\Photo;
use App\Traits\GhranTrait;
use Exception;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::with('album:id,name')->orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($photos as $photo){
            unset($photos[$i]);
            $photos->push(array_merge($photo->toArray(),['link'=>url('/api/photos/'.$photo->id)]));
            $i++;
        }
        return response($photos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotosRequest $request)
    {
        try{
            $photos=[];
            foreach($request->photos as $photo)
            {
                $folder = 'uploads/photos';
                $file_extension= $photo->getClientOriginalExtension();
                $file_name=random_int(100000,1000000000).'.'.$file_extension;
                $photo->move($folder,$file_name);
                $insert['photo'] = $file_name;
                $insert['album_id'] = $request->album_id;
                $insert['active'] = 1;
                $insert['order'] = Photo::max('order')+1;
                $new=Photo::create($insert);
                array_push($photos,$new);
            }
            return response($photos);
        }catch (\PHPUnit\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $photo->load('album:id,name');
        return response($photo);
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
    public function destroy(Photo $photo)
    {
        try{
            $this->deleteWithImage('uploads/photos/'.$photo->photo,$photo);
            return response(['message'=>'تم حذف الصورة بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function activation(Photo $photo)
    {
        if($photo->active == 0){
            $photo->update(['active'=>1]);
            return ['message'=>'تم تفعيل التعليق بنجاح'];
        }else{
            $photo->update(['active'=>0]);
            return ['message'=>'تم إلغاء تفعيل التعليق بنجاح'];
        }
    }
}
