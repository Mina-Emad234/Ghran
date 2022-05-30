<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $user=Auth()->guard('admin')->user();
        $admins=Admin::with('role')->where('id',"<>",auth()->id())->orderByDesc('id')->paginate(5);
        return view('admin.admins.index', compact('admins','user'));
    }

    public function create(){
        $roles=Role::get();
        return view('admin.admins.create',compact('roles'));
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
            return redirect()->route('admins.index')->with(['success_msg' =>"تم إضافة مسؤول بنجاح"]);

        }catch (\Exception $ex) {
//         return $ex;
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }

    public function edit(Admin $admin){
        $admin->load('role');
        $roles=Role::all();
        return view('admin.admins.update',compact('admin','roles'));
    }

    public function profileEdit(){
        $admin=Auth()->guard('admin')->user();
        $roles=Role::all();
        return view('admin.admins.update',compact('admin','roles'));
    }

    public function update(AdminRequest $request,Admin $admin){
        try {
            $active=$this->checkActive($request);
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

                return redirect()->route('admins.index')->with(['success_msg' => "تم تحديث مسؤول بنجاح"]);
        }catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }
    public function destroy(Admin $admin){
        try {
            $admin->delete();
                return redirect()->route('admins.index')->with(['success_msg' => "تم حذف مسؤول بنجاح"]);
        }catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }

    }

    public function activate(Admin $admin)
    {
        try {

            $admin->update(['active' => 1, 'login_attempts' => 0]);
            return redirect()->route('admins.index')->with(['success_msg' => "تم تفعيل مسؤول بنجاح"]);
        } catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }
    public function deactivate(Admin $admin){
        return $this->modelActivation($admin,0, "تم إلغاء تفعيل مسؤول بنجاح",'admins.index');
    }

    public function show(){
        return abort(404);
    }
}
