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

    public function album(){
        return $this->belongsTo(Album::class, 'album_id','id');
    }
}
