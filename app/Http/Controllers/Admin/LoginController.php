<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }
    public function postLogin(AdminLoginRequest $request)
    {
//       return $request;
        //check credentials
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1], $remember_me)) {
            $admin=Admin::where('email',$request->input('email'))->first();
            $admin->update(['login_attempts'=>0]);
            return redirect()->route('admin.home');
        }
        $admin=Admin::where('email',$request->input('email'))->first();

        if($admin){
            if($admin->status == 0) {
                return redirect()->back()->withInput()->with(['auth_error' => "تم حظر هذا الحساب، من فضلك تواصل مع المسؤل لإسترجاع الحساب."]);
            }
            $admin->update(['login_attempts'=>$admin->login_attempts+=1]);
            if ($admin->login_attempts >= 5){
                $admin->update(['status'=> 0]);
            }
        }
        return redirect()->back()->withInput()->with(['auth_error'=>"هناك خطأ في البريد الإلكتروني أو كلمة السر، من فضلك حاول مرة أخرى."]);
    }
    public function getGuard(){
        return auth('admin');
    }

    public function logout(){
        $guard = $this->getGuard();
        $guard->logout();
        return redirect()->route('admin.login');
    }


}
