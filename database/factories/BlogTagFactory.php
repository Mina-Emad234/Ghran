<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogTagFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'blog_id'=>Blog::inRandomOrder()->first()->id,
            'tag_id'=>Tag::inRandomOrder()->first()->id,
        ];
    }
}
