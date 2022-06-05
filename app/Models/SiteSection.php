<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSection extends Model
{
    use softDeletes;
    protected $table='site_sections';
    protected $fillable=['name','slug','section_type'];
    public $timestamps=true;


    public function image(){
        return $this->hasOne(SiteImage::class,'site_section_id','id');
    }

    public function site_contents(){
        return $this->hasMany(SiteContent::class,'site_section_id','id');
    }

    public function links(){
        return $this->hasMany(SiteLink::class,'site_section_id','id');
    }
}
