<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'content' => $this->faker->text(200),
            'price' => $this->faker->randomDigit(),
            'status' => $this->faker->boolean,
        ];
    }
}
