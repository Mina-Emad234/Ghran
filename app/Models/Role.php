<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable =['name','permissions'];
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(Admin::class);
    }
    public function getPermissionsAttribute($permission)
    {
        return json_decode($permission);
    }
}
