<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Http\Requests\Admin\PartnersRequest;
use App\Models\Partner;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PartnersController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $partners = Partner::orderBy('order','asc')->paginate(10);
        return view('admin.partners.index',compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(PartnersRequest $request)
    {
        try{
            $active=$this->checkActive($request);
            $file_name=$this->upload($request->image,'uploads/partners');
            $add = Partner::create([
                'name'=>$request->name,
                'image'=>$file_name,
                'active'=>$active,
                'order'=>Partner::max('order') + 1
            ]);
            return redirect()->route('partners.index')->with(['success_msg'=>'تم إضافة شريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.update',compact('partner'));
    }

    public function update(PartnersRequest $request,Partner $partner)
    {
        try {
            $active=$this->checkActive($request);
            $this->updateUpload($request,"image",'uploads/partners',$partner->image,$partner);
            $data['name'] = $request->name;
            $data['active'] = $active;
            $partner->update($data);
            return redirect()->route('partners.index')->with(['success_msg' => 'تم تحديث الشريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Partner $partner){
        try{
            $this->deleteWithImage('uploads/partners/'.$partner->image,$partner);
            return redirect()->route('partners.index')->with(['success_msg'=>'تم حذف الشريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate(Partner $partner){
        return $this->modelActivation($partner,1,'تم تفعيل الشريك بنجاح','partners.index');
    }

    public function deactivate(Partner $partner){
        return $this->modelActivation($partner,0,'تم إلغاء تفعيل الشريك بنجاح','partners.index');
    }
    public function sort(Partner $partner,$direction = 'up')
    {
        return $this->sortData($partner,'partners.index',$direction);
    }



}
