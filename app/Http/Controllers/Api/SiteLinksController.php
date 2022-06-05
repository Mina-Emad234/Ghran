<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SiteLinksRequest;
use App\Models\SiteLink;
use App\Models\SiteSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = SiteLink::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($links as $link){
            unset($links[$i]);
            $links->push(array_merge($link->toArray(),['show_link'=>url('/api/site/links_api/'.$link->id)]));
            $i++;
        }
        return $links;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteLinksRequest $request)
    {
        try {
            if (SiteSection::where('section_type', 'front links')->find($request->site_section_id)){
                $link = SiteLink::create([
                'name' => $request->name,
                'site_section_id' => $request->site_section_id,
                'parent_id' => $request->parent_id,
                'link' => $request->link,
                'status' => $request->status
                ]);
                return response($link);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return response(SiteLink::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteLinksRequest $request, int $id)
    {
        try {
            $link = SiteLink::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id);
            if($request->has('id') && $request->id == $link->id) {
                if($request->has('site_section_id') && !SiteSection::where('section_type', 'pages')->find($request->site_section_id)) {
                    $link->update($request->except('site_section_id'));
                }else{
                    $link->update($request->all());
                }                return response($link);
            }
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $link = SiteLink::whereIn('site_section_id',SiteSection::pluck('id')->toArray())->findOrFail($id);
            $link->delete();
            return response(['message'=>'تم حذف الرابط بنجاح']);
        }catch (\Exception $e){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
