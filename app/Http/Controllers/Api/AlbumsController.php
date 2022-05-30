<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AlbumsRequest;
use App\Models\Album;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class AlbumsController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($albums as $album){
            unset($albums[$i]);
            $albums->push(array_merge($album->toArray(),['link'=>url('/api/albums/'.$album->id)]));
            $i++;
        }
        return $albums;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumsRequest $request)
    {
        try{
            $file_name=$this->upload($request->image,'uploads/albums');
            $album = Album::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','-',$request->name),
                'image'=>$file_name
            ]);
            return $album;
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
    public function show(Album $album)
    {
        $album->load('photos:id,album_id,photo');
        return response($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumsRequest $request, Album $album)
    {
        try{
            if($request->has('id') && $request->id == $album->id) {

                $data = $request->except('image');
                $this->updateUpload($request, "image", 'uploads/albums', $album->image, $album);
                if ($request->has('name')) {
                    $data['slug'] = str_replace(' ', '-', $request->name);
                }
                $album->update($data);

                return response($album);
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
    public function destroy(Album $album)
    {
        try{
            foreach($album->photos as $photo){
                storage::disk('photos')->delete($photo->photo);
            }
            $this->deleteWithImage('uploads/albums/'.$album->image,$album);
            return response(['message'=>'تم حذف الألبوم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
