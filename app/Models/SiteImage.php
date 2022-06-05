<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $table='site_images';
    protected $fillable=['site_section_id','image'];
    public $timestamps=true;
    protected $appends=['image_url'];

    public function site_section(){
        return $this->belongsTo(SiteSection::class,'site_section_id','id');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('site/img/'.$this->image);
    }
}
