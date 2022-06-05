<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSectionRequest;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SiteSectionsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $sections = SiteSection::withTrashed()->orderByDesc('id')->paginate(10);
        return view('admin.site-sections.index',compact('sections'));
    }

    public function create()
    {
        return view('admin.site-sections.create');
    }

    public function store(SiteSectionRequest $request)
    {
        try {
            SiteSection::create([
                'name'=>$request->name,
                'section_type'=>$request->section_type,
            ]);
            return redirect()->route('site.sections.index')->with(['success_msg'=>'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function edit(SiteSection $section)
    {
        return view('admin.site-sections.update',compact('section'));
    }

    public function update(SiteSectionRequest $request,SiteSection $section)
    {
        try {
            $data['name']=$request->name;
            $data['section_type']=$request->section_type;
            $section->update($data);
            return redirect()->route('site.sections.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(SiteSection $section){
        try {
            $section->delete();
            return redirect()->route('site.sections.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function restore($id){
        try {
            SiteSection::withTrashed()->findOrFail($id)->restore();
            return redirect()->route('site.sections.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
