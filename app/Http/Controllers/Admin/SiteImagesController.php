<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteImageRequest;
use App\Models\SiteImage;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SiteImagesController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $site_images = SiteImage::with('site_section')->get();
        return view('admin.site-images.index',compact('site_images'));
    }

    public function create()
    {
        $sections = SiteSection::where('section_type','images')->get();
        return view('admin.site-images.create',compact('sections'));
    }

    public function store(SiteImageRequest $request)
    {
        try{
            if (SiteSection::where('section_type', 'images')->find($request->site_section_id)) {

                $section = SiteSection::withCount('image')->with('image')->where('section_type', 'images')->findOrFail($request->site_section_id);

                if ($section->image_count == 1 && $request->has('image') && file_exists('site/img/' . $section->image->image)) {
                    unlink('site/img/' . $section->image->image);
                }
                $file_name = $this->upload($request->image, 'site/img');
                SiteImage::updateOrCreate([
                    'site_section_id' => $section->id,
                ], [
                    'site_section_id' => $section->id,
                    'image' => $file_name,
                ]);
                return redirect()->route('site.images.index')->with(['success_msg' => 'تم إضافة صورة للموقع بنجاح']);
            }
        }catch (Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

}
