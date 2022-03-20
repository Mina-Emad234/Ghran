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
        $contents = SiteContent::with('site_section')->orderBy('id','desc')->paginate(10);
        return view('admin.content.index',compact('contents'));
    }

    public function create()
    {
        $sections = SiteSection::where('section_type','pages')->get();
        return view('admin.content.create',compact('sections'));
    }

    public function store(SiteContentRequest $request)
    {
        try {
            $active = $this->checkActive($request);
            $add = SiteContent::create([
                'title' => $request->title,
                'site_section_id' => $request->site_section_id,
                'body' => $request->body,
                'active' => $active
            ]);
            return redirect()->route('site_content')->with(['success_msg' => 'تم إضافة محتوى بنجاح']);
        }catch (\Exception $ex){
            return $ex;
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }
    public function show($id)
    {
        $content = SiteContent::with('site_section')->find($id);
        if (!$content)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        return view('admin.content.show',compact('content'));
    }
    public function edit($id)
    {
        $content = $this->checkModel(new SiteContent,$id );
        $sections = SiteSection::where('section_type','pages')->get();
        return view('admin.content.update',compact('content','sections'));
    }

    public function update($id,SiteContentRequest $request)
    {
        try {
            $content = $this->checkModel(new SiteContent,$id );
            $active = $this->checkActive($request);
            $data['title'] = $request->title;
            $data['body'] = $request->body;
            $data['site_section_id'] = $request->site_section_id;
            $data['active'] = $active;
            $content->update($data);
            return redirect()->route('site_content')->with(['success_msg' => 'تم تحديث المحتوى بنجاح']);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }

    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $content = $this->checkModel(new SiteContent,$id );
            $content->delete();
            DB::commit();
            return redirect()->route('site_content')->with(['success_msg'=>'تم حذف المحتوى بنجاح']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new SiteContent,$id,1,'تم تفعيل المحتوى بنجاح','site_content');
    }

    public function deactivate($id){
        return $this->modelActivation(new SiteContent,$id,0,'تم إلغاء تفعيل المحتوى بنجاح','site_content');
    }
}
