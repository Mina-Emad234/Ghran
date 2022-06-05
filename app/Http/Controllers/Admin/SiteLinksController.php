<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteLinksRequest;
use App\Models\SiteLink;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteLinksController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $links = SiteLink::with('site_section')->orderBy('id','desc')->paginate(10);
        return view('admin.site-links.index',compact('links'));
    }

    public function create()
    {
        $parents = SiteLink::where(['status'=>1,'parent_id'=>null,'link'=>null])->get();
        $sections = SiteSection::where('section_type','front links')->get();
        return view('admin.site-links.create',compact('sections','parents'));
    }

    public function store(SiteLinksRequest $request)
    {
        try {
            if (SiteSection::where('section_type', 'front links')->find($request->site_section_id)) {

                $active = $this->checkActive($request);
                $add = SiteLink::create([
                    'name' => $request->name,
                    'site_section_id' => $request->site_section_id,
                    'parent_id' => $request->parent_id,
                    'link' => $request->link,
                    'status' => $active
                ]);
                return redirect()->route('site.links.index')->with(['success_msg' => 'تم إضافة رابط بنجاح']);
            }
        }catch (\Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function edit(SiteLink $link)
    {
        $sections = SiteSection::where('section_type','front links')->get();
        $parents = SiteLink::where(['active'=>1,'parent_id'=>null,'link'=>null])->get();
        return view('admin.site-links.update',compact('link','sections','parents'));
    }

    public function update(SiteLinksRequest $request,SiteLink $link)
    {
        try {
            if (SiteSection::where('section_type', 'front links')->find($request->site_section_id)) {

                $active = $this->checkActive($request);
                $data['name'] = $request->name;
                $data['link'] = $request->link;
                $data['parent_id'] = $request->parent_id;
                $data['site_section_id'] = $request->site_section_id;
                $data['active'] = $active;
                $link->update($data);
                return redirect()->route('site.links.index')->with(['success_msg' => 'تم تحديث الرابط بنجاح']);
            }
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function destroy(SiteLink $link){
        try {
            $link->delete();
            return redirect()->route('site.links.index')->with(['success_msg'=>'تم حذف الرابط بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(SiteLink $link){
        return $this->modelActivation($link,1,'تم تفعيل الرابط بنجاح','site.links.index');
    }

    public function deactivate(SiteLink $link){
        return $this->modelActivation($link,0,'تم إلغاء تفعيل الرابط بنجاح','site.links.index');
    }
}
