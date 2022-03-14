<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    protected $table="admins";
    protected $primaryKey = 'id';
    protected $fillable=['name','email','password','active','login_attempts','created_at','updated_at'];
    protected $fidden=['password','remember_token'];
    public $timestamps=true;

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');//one to one
    }

    public function hasAbility($permissions)//get permission from provider & check it
    {
        $role=$this->role;//get & check relation
        if(!$role){
            return false;
        }
        foreach ($role->permissions as $permission)
        {
            if(is_array($permissions) && in_array($permission,$permissions)){
                return true;
            }elseif (is_string($permissions) && strcmp($permissions,$permission) == 0){
                return true;
            }
        }
        return false;
    }
}
