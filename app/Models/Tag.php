<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table='tags';
    protected $fillable=['name','slug','active','order'];
    protected $hidden=['order'];
    public $timestamps=true;

    public function blogs(){
        return $this->belongsToMany(Blog::class,'blog_tag');
    }
}
