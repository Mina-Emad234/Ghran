<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    protected $model=Album::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;
        return [
            'name'=>$this->faker->sentence(1),
            'slug'=>$this->faker->slug(),
            'image'=>$this->faker->image(public_path('uploads/albums'),400,300,null,false,true) ,
        ];
    }
}
