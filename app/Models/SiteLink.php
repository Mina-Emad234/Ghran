<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteLink extends Model
{
   protected $table='site_links';
   protected $fillable=['name','site_section_id','parent_id','link','active'];
   public $timestamps = false;

    public function site_section(){
        return $this->belongsTo(SiteSection::class,'site_section_id','id');
    }

    public function _parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }

    public function _child(){
        return $this->hasMany(self::class,'parent_id','id');
    }
}
