<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'teams';
    protected $guarded = [];
    public $timestamps = false;
    protected $appends=['image_url'];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/volunteers/'.$this->image);
    }
}
