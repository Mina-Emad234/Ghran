<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $admins=Admin::with('role')->where('id',"<>",auth()->id())->paginate(5);
        return view('admin.admin.index', compact('admins'));
    }

    public function create(){
        $roles=Role::get();
        return view('admin.admin.create',compact('roles'));
    }

    public function store(AdminRequest $request){
        try {

            $active=$this->checkActive($request);
            $admin=new Admin();
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->password=bcrypt($request->password);
            $admin->role_id=$request->role_id;
            $admin->active=$active;
            $admin->save();
            return redirect()->route('admin.index')->with(['success_msg' =>"تم إضافة مسؤول بنجاح"]);

        }catch (\Exception $ex) {
//         return $ex;
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }

    public function edit($id){
        $admin = $this->checkModel(new Admin,$id);

        $roles=Role::get();
        return view('admin.admin.update',compact('admin','roles'));
    }

    public function update($id,AdminRequest $request){
        try {
            $active=$this->checkActive($request);
            $admin = $this->checkModel(new Admin,$id);
            $admin->name = $request->name;
                $admin->email = $request->email;
                if ($request->has('password')) {
                    $admin->password = bcrypt($request->password);
                }
                $admin->role_id=$request->role_id;
                $admin->active=$active;
                if($active){
                    $admin->login_attempts=0;
                }
                $admin->save();

                return redirect()->route('admin.index')->with(['success_msg' => "تم تحديث مسؤول بنجاح"]);
        }catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }
    public function delete($id){
        try {
            $admin = $this->checkModel(new Admin,$id);
            $admin->delete();
                return redirect()->route('admin.index')->with(['success_msg' => "تم حذف مسؤول بنجاح"]);
        }catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }

    }

    public function activate($id)
    {
        try {
            $admin = $this->checkModel(new Admin,$id);


            $admin->update(['active' => 1, 'login_attempts' => 0]);
            return redirect()->route('admin.index')->with(['success_msg' => "تم تفعيل مسؤول بنجاح"]);
        } catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }
    public function deactivate($id){
        return $this->modelActivation(new Admin, $id,0, "تم إلغاء تفعيل مسؤول بنجاح",'admin.index');
    }
}
