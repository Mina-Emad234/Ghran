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
        return [
            'photo'=>$this->faker->image(public_path('uploads/photos'),800,600,null,false,true) ,
            'album_id'=>Album::inRandomOrder()->first()->id,
            'active'=>1,
            'order'=>$order++,
        ];
    }
}
