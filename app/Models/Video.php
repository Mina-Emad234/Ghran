<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = ['course_id', 'name', 'author', 'video', 'image', 'status', 'order'];
    public $timestamps = true;
    protected $appends=['image_url','video_url'];

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/v_images/'.$this->course.'/'.$this->image);
    }

    public function getVideoUrlAttribute(): string
    {
        return asset('uploads/v_videos/'.$this->course.'/'.$this->video);
    }
}
