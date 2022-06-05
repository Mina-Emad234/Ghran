<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    protected $model=Photo::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;
        $album_id= Album::inRandomOrder()->first()->id;
        $album_name = Album::find($album_id)->name;
        return [
            'photo'=>$this->faker->image(public_path('uploads/photos/'.$album_name),800,600,null,false,true) ,
            'album_id'=$album_id,
            'status'=>1,
            'order'=>$order++,
        ];
    }
}
