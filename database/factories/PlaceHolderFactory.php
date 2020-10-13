<?php

namespace Database\Factories;

use App\Models\PlaceHolder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaceHolderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlaceHolder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'place'=>$this->faker->company,
            'category'=>$this->faker->randomElement(["حكومي","تعليمي","تجاري","ترفيهي","رياضي","مواصلات"]),
            'city'=>$this->faker->city,
            'area'=>$this->faker->address,
            'street'=>$this->faker->streetName,
            'name'=>$this->faker->name,
            'id_number'=>$this->faker->numberBetween(123456789,912345678),
            'phone'=>$this->faker->phoneNumber,
        ];
    }
}
