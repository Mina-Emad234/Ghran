<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'partners';
    protected $fillable =['name', 'image', 'active', 'order'];
    public $timestamps = true;

    protected $appends=['image_url'];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/partners/'.$this->image);
    }
}
