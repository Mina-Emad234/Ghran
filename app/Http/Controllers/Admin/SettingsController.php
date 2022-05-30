<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Exception;

class SettingsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index',compact('settings'));
    }



    public function edit(Setting $setting){
        return view('admin.settings.update',compact('setting'));
    }

    public function update(SettingRequest $request,Setting $setting)
    {
        try{
            $setting->update([
                'value'=>$request->value
            ]);
            Cache::forget('configs');
            return redirect()->route('settings.index')->with(['success_msg'=>'تم تحديث إعداد بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->withInput()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

}
