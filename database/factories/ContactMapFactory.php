<?php

namespace Database\Factories;

use App\Models\ContactMap;
use App\Models\patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactMapFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactMap::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_id=$this->faker->randomElement(patient::where('status','contact')->pluck('id'));
        $second_id=$this->faker->randomElement(patient::where('status','contact')->where('id','!=',$first_id)->pluck('id'));
        return [
            'contact_id'=>$first_id,
            'contact_with_id'=>$second_id,
            'place'=>$this->faker->address,
            'date'=>$this->faker->dateTime,
            'recognition_method'=>$this->faker->randomElement([1,2]),
        ];
    }
}
