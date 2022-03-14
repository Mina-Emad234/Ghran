<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=['blog_id','parent_id','writer','email','body','active'];
    public $timestamps=true;
    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
    public function _parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }
    /*
     * get parent from child
     */
    public function _child(){
        return $this->hasMany(self::class,'parent_id','id');
    }
}
