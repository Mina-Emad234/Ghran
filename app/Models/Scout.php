<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    use HasFactory;
    protected $table = 'scouts';
    protected $fillable=['name', 'image', 'school', 'grade', 'age', 'interests', 'address',
        'mobile', 'email', 'parent_name', 'parent_job',
        'parent_tel', 'parent_mobile', 'parent_email', 'read'];
    public $timestamps = false;
}
