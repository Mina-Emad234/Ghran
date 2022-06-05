<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $table = 'site_contents';
    protected $fillable = ['title', 'site_section_id', 'body', 'status'];
    public $timestamps = true;

    public function site_section(){
        return $this->belongsTo(SiteSection::class,'site_section_id','id');
    }
}
