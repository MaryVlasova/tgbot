<?php

namespace Database\Factories;

use App\Models\CategoryNotes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->realText(),
            'img' => null,   
            'author_id' => User::factory(),
            
          
        ];
    }
}
