<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteResult extends Model
{
    use HasFactory;
    protected $table='vote_results';
    protected $fillable=['vote_question_id','answer'];
    public $timestamps=false;

    public function question(){
        return $this->belongsTo(VoteQuestion::class,'vote_question_id','id');
    }
}
