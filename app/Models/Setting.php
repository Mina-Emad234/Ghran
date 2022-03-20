<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table='settings';
    protected $fillable=['key','value'];

    public static function setMany($settings){
        foreach ($settings as $key => $value){
            self::set($key,$value);
        }
    }

    public static function set($key,$value){//custom function

        if (is_array($value)){
            $value = json_encode($value);
        }
        static::updateOrCreate(['key'=>$key],['value'=>$value]);
    }
    public function scopeVal($query,$key){
        return $query->select('value')->where('key',$key)->first()->value;
    }

}
