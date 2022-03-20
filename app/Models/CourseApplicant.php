<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseApplicant extends Model
{
    use HasFactory;
    protected $table = 'course_applicants';
    protected $fillable = ['course_id', 'name', 'email', 'mobile', 'marital_status',
                            'address','job', 'city', 'age', 'payment_method', 'read'];
    public $timestamps=true;

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
