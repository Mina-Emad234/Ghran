<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table='contacts';
    protected $fillable=['sender', 'email', 'title', 'content', 'file', 'read'];
    public $timestamps=true;
    protected $appends=['file_url'];

    public function getFileUrlAttribute(): string
    {
        if($this->file == null)
            return 'No File Exists';

            return asset('uploads/contacts/'.$this->email .'/'.$this->file);
    }
}
