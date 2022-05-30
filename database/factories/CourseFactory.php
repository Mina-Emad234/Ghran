<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class CourseFactory extends Factory
{
    protected $model = Course::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $payable=$this->faker->boolean();
        $price=$payable == true ? rand(20,70)*100:NULL;
        static $order = 1;
        return [
            'name'=>$this->faker->sentence(1),
            'description'=>$this->faker->paragraph(8),
            'duration'=>rand(20,40),
            'licence'=>$this->faker->text(70),
            'image'=>$this->faker->image(public_path('uploads/courses'),400,300,null,false,true) ,
            'active'=>1,
            'course_payable'=>$payable,
            'price'=>$price,
            'order'=>$order++,
        ];
    }
}
