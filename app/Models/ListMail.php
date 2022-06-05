<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListMail extends Model
{
    use HasFactory;
    protected $table='list_mails';
    protected $fillable=['name', 'email'];
    public $timestamps=true;
}
