<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteImage extends Model
{
    protected $table='site_images';
    protected $fillable=['site_part','image'];
    public $timestamps=false;
}
