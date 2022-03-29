<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'names' => $this->faker->firstName(),
            'surnames' => $this->faker->lastName(),
            'document' => 1,
            'document_type' => 'C.C',
            'user_id' => 1
        ];
    }
}
