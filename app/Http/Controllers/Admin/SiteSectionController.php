<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSectionRequest;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SiteSectionController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $sections = SiteSection::paginate(10);
        return view('admin.site_section.index',compact('sections'));
    }

    public function create()
    {
        return view('admin.site_section.create');
    }

    public function store(SiteSectionRequest $request)
    {
        try {
            SiteSection::create([
                'name'=>$request->name,
                'slug'=>str_replace(' ','_',$request->name),
                'section_type'=>$request->section_type,
            ]);
            return redirect()->route('site_section.index')->with(['success_msg'=>'تم إضافة قسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function edit($id)
    {
        $section = $this->checkModel(new SiteSection,$id);
        return view('admin.site_section.update',compact('section'));
    }

    public function update($id,SiteSectionRequest $request)
    {
        try {
            $section = $this->checkModel(new SiteSection,$id);
            $data['name']=$request->name;
            $data['slug']=str_replace(' ','_',$request->name);
            $data['section_type']=$request->section_type;
            $section->update($data);
            return redirect()->route('site_section.index')->with(['success_msg'=>'تم تحديث القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try {
            $section = $this->checkModel(new SiteSection,$id);
            $section->delete();
            return redirect()->route('site_section.index')->with(['success_msg'=>'تم حذف القسم بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
