<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryNotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),            
            'img' => $this->faker->randomElement(['category-notes/icon-blue.png','category-notes/icon-red.png']) 
            ];
    }
}
