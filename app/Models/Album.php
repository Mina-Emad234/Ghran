<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table='albums';
    protected $fillable=['name','slug','image'];
    public $timestamps=false;

    public function photos(){
        return $this->hasMany(Photo::class,'album_id','id');
    }
}
