<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = ['course_id', 'name', 'author', 'video', 'image', 'active', 'order'];
    public $timestamps = true;

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
