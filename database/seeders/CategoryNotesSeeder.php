<?php

namespace Database\Seeders;

use App\Models\CategoryNotes;
use App\Models\ColorOfNoteCategory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategoryNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultColor = ColorOfNoteCategory::take(1)->first();
        $darkColor = ColorOfNoteCategory::where('code', 'dark')->first();
        $primaryColor = ColorOfNoteCategory::where('code', 'primary')->first();
        $dangerColor = ColorOfNoteCategory::where('code', 'danger')->first();
        $successColor = ColorOfNoteCategory::where('code', 'success')->first();
        
 
        CategoryNotes::factory()   
        ->count(4)             
        ->state(new Sequence(
            [
                'name' => 'Важно',
                'img' => 'category-notes/examples/icon-red.png',
                'color_id' => isset($darkColor->id) ? $darkColor->id : $defaultColor->id
            ],
            [
                'name' => 'Немедленно',
                'img' => 'category-notes/examples/icon-dark-red.png',
                'color_id' => isset($dangerColor->id) ? $dangerColor->id : $defaultColor->id                
            ],
            [
                'name' => 'Информация', 
                'img' => 'category-notes/examples/icon-blue.png',
                'color_id' => isset($primaryColor->id) ? $primaryColor->id : $defaultColor->id                
            ],
            [
                'name' => 'Вопрос', 
                'img' => 'category-notes/examples/icon-question.png',
                'color_id' => isset($successColor->id) ? $successColor->id : $defaultColor->id                
            ],
        ))  
        ->create();
    }
}
