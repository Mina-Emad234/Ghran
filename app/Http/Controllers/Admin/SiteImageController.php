<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteImageRequest;
use App\Models\SiteImage;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SiteImageController extends Controller
{
    public function index()
    {
        $site_images = SiteImage::get();
        return view('admin.site_image.index',compact('site_images'));
    }

    public function create()
    {
        return view('admin.site_image.create');
    }

    public function store(SiteImageRequest $request)
    {
        try{
            if ($request->has('image') && file_exists('site/img/banner-' . $request->site_part . '.jpg')) {
                unlink('site/img/banner-' . $request->site_part . '.jpg');
            }
                $photo=$request->image;
                $folder = 'site/img';
                $file_name='banner-'.$request->site_part.'.jpg';
                $photo->move($folder,$file_name);
                SiteImage::updateOrCreate([
                    'site_part'=>$request->site_part,
                    ],[
                    'site_part'=>$request->site_part,
                    'image'=>$file_name,
                ]);

            return redirect()->route('site_image.index')->with(['success_msg'=>'تم إضافة صورة للموقع بنجاح']);
        }catch (Exception $ex){
            return $ex;
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

}
