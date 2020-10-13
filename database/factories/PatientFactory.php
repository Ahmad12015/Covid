<?php

namespace Database\Factories;

use App\Models\patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class patientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['healthy','injured ','contact']),
            'id_number' => $this->faker->unique()->numberBetween(1020304050,2020304050),
            'first_name' => $this->faker->firstName,
            'father_name' => $this->faker->firstName,
            'granddad_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender'=>$this->faker->randomElement(['male','female']),
            'phone'=>$this->faker->phoneNumber,
            'city' => $this->faker->city,
            'area' => $this->faker->address,
            'date_injury' =>$this->faker->date(),
        ];
    }
}
