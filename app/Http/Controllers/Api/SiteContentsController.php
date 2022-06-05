<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SiteContentsRequest;
use App\Models\SiteContent;
use App\Models\SiteSection;
use Illuminate\Http\Request;

class SiteContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = SiteContent::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($contents as $content){
            unset($contents[$i]);
            $contents->push(array_merge($content->toArray(),['show_content'=>url('/api/site/contents_api/'.$content->id)]));
            $i++;
        }
        return $contents;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteContentsRequest $request)
    {
        try {
            if (SiteSection::where('section_type', 'pages')->find($request->site_section_id)){
                    $content = SiteContent::create([
                        'title' => $request->title,
                        'site_section_id' => $request->site_section_id,
                        'body' => $request->body,
                        'active' => $request->status
                    ]);
                return response($content);
            }else{
                return response(['error_msg' => 'هناك مشكلة ما لقسم غير موجود أو غير مناسب'],422);
            }
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response(SiteContent::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteContentsRequest $request, int $id)
    {
        try {
            $content=SiteContent::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id);
            if($request->has('id') && $request->id == $content->id) {
                if($request->has('site_section_id') && !SiteSection::where('section_type', 'pages')->find($request->site_section_id)) {
                    $content->update($request->except('site_section_id'));
                }else{
                    $content->update($request->all());
                }
                return response($content);
            }
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $content=SiteContent::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id);
            $content->delete();
            return response(['message'=>'تم حذف المحتوى بنجاح']);
        }catch (\Exception $e){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
