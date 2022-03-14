<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteQuestion extends Model
{
    use HasFactory;
    protected $table='vote_questions';
    protected $fillable=['question','answer1','answer2','answer3','answer4','active','order'];
    public $timestamps=true;

    public function answers(){
        return $this->hasMany(VoteResult::class,'vote_question_id','id');
    }
}
