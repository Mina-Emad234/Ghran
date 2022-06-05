<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table='albums';
    protected $fillable=['name','slug','image','status'];
    public $timestamps=true;

    protected $appends=['image_url'];

    public function photos(){
        return $this->hasMany(Photo::class,'album_id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/albums/'.$this->image);
    }

}
