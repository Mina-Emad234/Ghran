<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryRequest;
use App\Models\Partner;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('order','asc')->paginate(10);
        return view('admin.partner.index',compact('partners'));
    }

    public function create()
    {
        return view('admin.partner.create');
    }

    public function store(BlogCategoryRequest $request)
    {
        try{
            if($request->has('active')){
                $active=1;
            }else{
                $active=0;
            }
            $photo = $request->image;
            $folder = 'uploads/partners';
            $file_extension= $photo->getClientOriginalExtension();
            $file_name=time().'.'.$file_extension;
            $path=$folder;
            $photo->move($path,$file_name);
            $add = Partner::create([
                'name'=>$request->name,
                'image'=>$file_name,
                'active'=>$active,
                'order'=>Partner::max('order') + 1
            ]);
            return redirect()->route('partner.index')->with(['success_msg'=>'تم إضافة شريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        if (!$partner)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

        return view('admin.partner.update',compact('partner'));
    }

    public function update($id,BlogCategoryRequest $request)
    {
        try {
        $partner = Partner::find($id);
        if($request->has('active')){
            $active=1;
        }else{
            $active=0;
        }
        if (!$partner)
            return redirect()->back()->withInput()->with(['error_msg'=>'هناك مشكلة ما لم يتم تحديث الشريك من فضلك حاول مرة أخرى']);

            if ($request->has('image') && file_exists('uploads/partners/' . $partner->image)) {
                unlink('uploads/partners/' . $partner->image);
                $photo = $request->image;
                $folder = 'uploads/partners';
                $file_extension = $photo->getClientOriginalExtension();
                $file_name = time() . '.' . $file_extension;
                $path = $folder;
                $photo->move($path, $file_name);
                $partner->update([
                    'image' => $file_name
                ]);
            }
            $data['name'] = $request->name;
            $data['active'] = $active;
            $partner->update($data);
            return redirect()->route('partner.index')->with(['success_msg' => 'تم تحديث الشريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $partner = Partner::find($id);
            if (!$partner)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما لم يتم حذف شريك من فضلك حاول مرة أخرى']);
            if(file_exists('uploads/partners/'.$partner->image)){
                unlink('uploads/partners/'.$partner->image);
            }
            $partner->delete();
            return redirect()->route('partner.index')->with(['success_msg'=>'تم حذف الشريك بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        $partner = Partner::find($id);
        if (!$partner)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما لم يتم تفعيل شريك من فضلك حاول مرة أخرى']);
        $activate = $partner->update(['active'=>1]);
        return redirect()->route('partner.index')->with(['success_msg'=>'تم تفعيل الشريك بنجاح']);
    }

    public function deactivate($id){
        $partner = Partner::find($id);
        if (!$partner)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما لم يتم إلغاء تفعيل شريك من فضلك حاول مرة أخرى']);
        $deactivate = $partner->update(['active'=>0]);
        return redirect()->route('partner.index')->with(['success_msg'=>'تم إلغاء تفعيل الشريك بنجاح']);
    }
    public function sort($direction = 'up', $id = '')
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }else{
            switch ($direction) {
                case 'up':
                    $this->sortPartner($direction, $id);
                    break;
                case 'down':
                    $this->sortPartner($direction, $id);
                    break;
                default:
                    break;
            }
            return redirect()->route('partner.index');
        }
    }

    public function sortPartner($direction = 'up', $id = ''){
        $page = Partner::where('id',$id)->first();
        if ($direction == 'up') {
            $order = Partner::where("order", '<', $page->order)->orderBy('order','desc')->first();
        } else {
            $order =  Partner::where("order", '>', $page->order)->orderBy('order','asc')->first();
        }
        if ($order) {
            $page->where('id',$id)->update(['order'=>$order->order]);
            $order->where('id',$order->id)->update(['order'=>$page->order]);
            return TRUE;
        }
    }
}
