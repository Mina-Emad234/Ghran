<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class RolesController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $roles=Role::orderByDesc('id')->paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request){
        try{
            $role = $this->process(new Role, $request);

            return redirect()->route('roles.index')->with(['success_msg' => 'تم إضافة صلاحية بنجاح ']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function edit(Role $role){

        return view('admin.roles.update', compact('role'));
    }

    public function update(RoleRequest $request,Role $role){
        try{
            $role = $this->process($role, $request);
                return redirect()->route('roles.index')->with(['success_msg' => 'تم تحديث صلاحية بنجاح ']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function destroy(Role $role){
        try {
            $role->delete();
                return redirect()->route('roles.index')->with(['success_msg' => 'تم حذف صلاحية بنجاح ']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

    public function process(Role $role,Request $r)
    {
        $role->name=$r->name;
        $role->permissions=json_encode($r->permissions);
        $role->save();
        return $role;
    }

}
