<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class SettingController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $settings = Setting::get();
        return view('admin.setting.index',compact('settings'));
    }

    public function create()
    {
        $settings = Setting::get();
        return view('admin.setting.create',compact('settings'));
    }

    public function add(SettingRequest $request)
    {
        try{
            Setting::updateOrCreate(
                ['key'=>$request->key], ['value'=>$request->value]
            );
            return redirect()->route('setting.index')->with(['success_msg'=>'تم إضافة إعداد بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id){
        $setting =$this->checkModel(new Setting,$id);
        return view('admin.setting.update',compact('setting'));
    }

    public function update($id,SettingRequest $request)
    {
        try{
            $setting =$this->checkModel(new Setting,$id);
            $setting->update([
                'key'=>$request->key,
                'value'=>$request->value
            ]);
            return redirect()->route('setting.index')->with(['success_msg'=>'تم تحديث إعداد بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $setting =$this->checkModel(new Setting,$id);
            $delete = $setting->delete();

            return redirect()->route('setting.index')->with(['success_msg'=>'تم حذف الإعداد  بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}