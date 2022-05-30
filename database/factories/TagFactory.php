<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        static $order = 1;
        return [
            'name'=>$this->faker->sentence(1),
            'slug'=>$this->faker->slug(),
            'active'=>1,
            'order'=>$order++,
        ];
    }
}
