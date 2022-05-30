<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table ='photos';
    protected $fillable = ['photo', 'album_id', 'active', 'order'];
    public $timestamps = true;
    protected $appends=['photo_url'];


    public function album(){
        return $this->belongsTo(Album::class, 'album_id','id');
    }

    public function getPhotoUrlAttribute(): string
    {
        return asset('uploads/photos/'.$this->photo);
    }
}
