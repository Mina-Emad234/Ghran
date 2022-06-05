<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SectionsRequest;
use App\Models\SiteSection;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = SiteSection::withTrashed()->orderBy('id','desc')->paginate(10);
        $i=0;
        foreach ($sections as $section){
            unset($sections[$i]);
            $sections->push(array_merge($section->toArray(),['link'=>url('/api/sections_api/'.$section->id)]));
            $i++;
        }
        return response($sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionsRequest $request)
    {
        try{
            $section=SiteSection::create([
                'name'=>$request->name,
                'section_type'=>$request->section_type,
            ]);
            return response($section);
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
    public function show($id)
    {
        return response(SiteSection::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionsRequest $request, $id)
    {
        try{
            $section=SiteSection::findOrFail($id);
            if($request->has('id') && $request->id == $section->id) {

                $section->update($request->all());
                return response($section);
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

    public function destroy($id)
    {
        try{
            SiteSection::findOrFail($id)->delete();
            return response(['message'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function restore($id)
    {
        try{
            SiteSection::withTrashed()->findOrFail($id)->restore();
            return response(['message'=>'تم إسترجاع القسم بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
