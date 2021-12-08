<?php

namespace Database\Factories;

use App\Models\CategoryNotes;
use App\Models\User;
use Carbon\Carbon;
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
        $userIds = User::all()->pluck('id');
        $categoryNotesIds = CategoryNotes::all()->pluck('id');      
        return [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->realText(),
            'img' => null,   
            'author_id' => $userIds->random(),
            'category_notes_id' => $categoryNotesIds->random(),
            'created_at'  => Carbon::instance($this->faker->dateTimeBetween('-1 months','now'))
        ];
    }
}
