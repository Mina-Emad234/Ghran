<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    protected $model=Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>BlogCategory::inRandomOrder()->first()->id,
            'title'=>$this->faker->sentence(2),
            'slug'=>$this->faker->slug(),
            'body'=>$this->faker->paragraph(8),
            'image'=>$this->faker->image(public_path('uploads/blogs'),500,350,null,false,true) ,
            'active'=>1,
        ];
    }
}
