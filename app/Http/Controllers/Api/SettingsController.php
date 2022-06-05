<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SettingsRequest;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::withTrashed()->orderBy('id','desc')->paginate(10);
        $i=0;
        foreach ($settings as $setting){
            unset($settings[$i]);
            $settings->push(array_merge($setting->toArray(),['link'=>url('/api/settings_api/'.$setting->id)]));
            $i++;
        }
        return $settings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Setting::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request, $id)
    {
        try{
            $setting = Setting::findOrFail($id);
            $setting->update([
                'value'=>$request->value
            ]);
            return response($setting);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Setting::findOrFail($id)->delete();
            Cache::forget('configs');
            return response(['message'=>'تم حذف الإعداد بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    public function restore($id)
    {
        try{
            Setting::withTrashed()->findOrFail($id)->restore();
            Cache::forget('configs');
            return response(['message'=>'تم إسترجاع الإعداد بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
