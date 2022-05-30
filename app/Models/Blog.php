<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable=['category_id','title', 'slug','body','image','active'];
    public $timestamps = true;

    protected $appends=['image_url'];

    public function category(){
        return $this->belongsTo(BlogCategory::class,'category_id','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'blog_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'blog_tag','blog_id','tag_id','id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/blogs/'.$this->image);
    }

}
