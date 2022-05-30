<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(UsersRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->login_url = url('/api/auth/login');
        return response($user);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken($user->email);
            $user->token=$token->plainTextToken;
            return $user;
        }
        return response(['message'=>'Invalid Credentials'],401);
    }

    public function getAllTokens(Request $request)
    {
        return $request->user()->tokens;
    }

    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return ['message'=>'logout successfully'];
    }

    public function logoutAllDevices()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return ['message'=>'logout All Devices successfully'];
    }

    public function deleteToken($id)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->findOrFail($id)->delete();
        return ['message'=>'Token Deleted successfully'];
    }
}
