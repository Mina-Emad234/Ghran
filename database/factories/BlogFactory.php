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
        $cat_id = BlogCategory::inRandomOrder()->first()->id;
        $cat_name = BlogCategory::find($cat_id)->name;
        return [
            'category_id'=>$cat_id,
            'title'=>$this->faker->sentence(2),
            'slug'=>$this->faker->slug(),
            'body'=>$this->faker->paragraph(8),
            'image'=>$this->faker->image(public_path('uploads/blogs/'.$cat_name),500,350),
            'status'=>1,
        ];
    }
}
