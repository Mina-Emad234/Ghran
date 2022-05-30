<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('order','desc')->paginate(10);
        $i=0;
        foreach ($tags as $tag){
            unset($tags[$i]);
            $tags->push(array_merge($tag->toArray(),['link'=>url('/api/tags/'.$tag->id)]));
            $i++;
        }
        return $tags;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        try{
            $tag = Tag::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','-',$request->name),
                'order'=>tag::max('order') + 1,
                'active'=>$request->active
            ]);
            return $tag;
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
    public function show(Tag $tag)
    {
        return response($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsRequest $request,Tag $tag)
    {
        try{
            if($request->has('id') && $request->id == $tag->id) {

                $data = $request->all();
                if ($request->has('name')) {
                    $data['slug'] = str_replace(' ', '-', $request->name);
                }
                $tag->update($data);

                return response($tag);
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
    public function destroy(Tag $tag)
    {
        try{
            $tag->delete();
            return response(['message'=>'تم حذف كلمة البحث بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
