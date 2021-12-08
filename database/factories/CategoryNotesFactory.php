<?php

namespace Database\Factories;

use App\Models\ColorOfNoteCategory;
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
        $colorIds = ColorOfNoteCategory::all()->pluck('id');
        return [
            'name' => $this->faker->word(),            
            'img' => $this->faker->randomElement([
                'category-notes/examples/icon-blue.png',
                'category-notes/examples/icon-dark-red.png',
                'category-notes/examples/icon-red.png',
                'category-notes/examples/icon-question.png'
            ]),
            'color_id' => $colorIds->random()
            ];
    }
}
