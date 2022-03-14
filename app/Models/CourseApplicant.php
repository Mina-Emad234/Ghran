<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseApplicant extends Model
{
    use HasFactory;
    protected $table = 'course_applicants';
    protected $fillable = ['course_id', 'name', 'email', 'mobile', 'marita_status', 'job', 'city', 'age', 'read'];
    public $timestamps=false;

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
