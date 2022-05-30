<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table='blog_categories';
    protected $fillable=['name','slug','image'];
    public $timestamps=false;
    protected $appends=['image_url'];

    public function blogs(){
        return $this->hasMany(Blog::class,'category_id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/categories/'.$this->image);
    }
}
