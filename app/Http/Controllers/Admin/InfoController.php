<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfoRequest;
use App\Models\Info;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class InfoController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $infos = Info::orderBy('order','asc')->paginate(10);
        return view('admin.info.index',compact('infos'));
    }

    public function create()
    {
        return view('admin.info.create');
    }

    public function store(InfoRequest $request)
    {
        try{
            $active = $this->checkActive($request);
            $add = Info::create([
                    'body'=>$request->body,
                    'order'=>Info::max('order') + 1,
                    'active'=>$active
                ]);
            return redirect()->route('info.index')->with(['success_msg'=>'تم إضافة معلومة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit($id)
    {
        $info = $this->checkModel(new Info,$id);
        return view('admin.info.update',compact('info'));
    }

    public function update($id,InfoRequest $request)
    {
        try{
            $info = $this->checkModel(new Info,$id);
            $active = $this->checkActive($request);

            $data['body']=$request->body;
            $data['active']=$active;
            $update = $info->update($data);

            return redirect()->route('info.index')->with(['success_msg'=>'تم تحديث المعلومة بنجاح']);
        }catch (Exception $ex){
             return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function delete($id){
        try{
            $info = $this->checkModel(new Info,$id);

            $delete = $info->delete();

            return redirect()->route('info.index')->with(['success_msg'=>'تم حذف المعلومة بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function activate($id){
        return $this->modelActivation(new Info,$id,1,'تم تفعيل المعلومة بنجاح','info.index');
    }

    public function deactivate($id){
        return $this->modelActivation(new Info,$id,1,'تم إلغاء تفعيل المعلومة بنجاح','info.index');
    }

    public function sort($direction = 'up', $id = '')
    {
        $info = $this->checkModel(new Info,$id);
        return $this->sortData(new Info,'info.index',$direction,$id);
    }

}
