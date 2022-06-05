<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteContentRequest;
use App\Models\SiteContent;
use App\Models\SiteSection;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteContentController extends Controller
{
    use GhranTrait;
    public function index()
   {
        $contents = SiteContent::with('site_section')->orderBy('id','desc')->whereIn('site_section_id',SiteSection::pluck('id')->toArray())->paginate(10);
        return view('admin.site-content.index',compact('contents'));
    }

    public function create()
    {
        $sections = SiteSection::where('section_type','pages')->get();
        return view('admin.site-content.create',compact('sections'));
    }

    public function store(SiteContentRequest $request)
    {
        try {
            if (SiteSection::where('section_type', 'pages')->find($request->site_section_id)){
                $active = $this->checkActive($request);
                $add = SiteContent::create([
                    'title' => $request->title,
                    'site_section_id' => $request->site_section_id,
                    'body' => $request->body,
                    'active' => $active
                ]);
                return redirect()->route('site.content.index')->with(['success_msg' => 'تم إضافة محتوى بنجاح']);
            }
        }catch (\Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }
    public function show(SiteContent $content)
    {
       return view('admin.site-content.show',compact('content'));
    }
    public function edit(SiteContent $content)
    {
        $sections = SiteSection::where('section_type','pages')->get();
        return view('admin.site-content.update',compact('content','sections'));
    }

    public function update(SiteContentRequest $request,SiteContent $content)
    {
        try {
            if (SiteSection::where('section_type', 'pages')->find($request->site_section_id)) {
                $active = $this->checkActive($request);
                $data['title'] = $request->title;
                $data['body'] = $request->body;
                $data['site_section_id'] = $request->site_section_id;
                $data['active'] = $active;
                $content->update($data);
                return redirect()->route('site.content.index')->with(['success_msg' => 'تم تحديث المحتوى بنجاح']);
            }
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function destroy(SiteContent $content){
        try {
            $content->delete();
            return redirect()->route('site.content.index')->with(['success_msg'=>'تم حذف المحتوى بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(SiteContent $content){
        return $this->modelActivation($content,1,'تم تفعيل المحتوى بنجاح','site.content.index');
    }

    public function deactivate(SiteContent $content){
        return $this->modelActivation($content,0,'تم إلغاء تفعيل المحتوى بنجاح','site.content.index');
    }
}
