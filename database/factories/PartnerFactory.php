<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    protected $model=Partner::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $order = 1;
        return [
            'name'=>$this->faker->name,
            'image'=>$this->faker->image(public_path('uploads/partners'),400,300,null,false,true) ,
            'status'=>1,
            'order'=>$order++,
        ];
    }
}
