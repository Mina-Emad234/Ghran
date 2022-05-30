<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table='courses';
    protected $fillable=['name', 'description', 'duration', 'licence', 'image', 'active', 'order','price','course_payable'];
    public $timestamps=true;

    protected $appends=['image_url'];

    public function videos(){
        return $this->hasMany(Video::class,'course_id','id');
    }

    public function applicants(){
        return $this->hasMany(CourseApplicant::class,'course_id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/courses/'.$this->image);
    }

}
