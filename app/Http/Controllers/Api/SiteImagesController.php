<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SiteImagesRequest;
use App\Models\SiteImage;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SiteImagesController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = SiteImage::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($images as $image){
            unset($images[$i]);
            $images->push(array_merge($image->toArray(),['link'=>url('/api/site/images/'.$image->id)]));
            $i++;
        }
        return $images;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteImagesRequest $request)
    {
        try{
            if (SiteSection::where('section_type', 'images')->find($request->site_section_id)){
                $section=SiteSection::withCount('image')->with('image')->where('section_type','images')->findOrFail($request->site_section_id);

                if ($section->image_count == 1 && $request->has('image') && file_exists('site/img/'.$section->image->image)) {
                    unlink('site/img/'.$section->image->image);
                }
                $file_name=$this->upload($request->image,'site/img');
                $image=SiteImage::updateOrCreate([
                    'site_section_id'=>$section->id,
                ],[
                    'site_section_id'=>$section->id,
                    'image'=>$file_name,
                ]);
                return response($image);
            }else{
                return response(['error_msg' => 'هناك مشكلة ما لقسم غير موجود أو غير مناسب'],422);
            }
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
    public function show(SiteImage $image)
    {
        return response($image);
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
    public function destroy($id)
    {
        //
    }
}
