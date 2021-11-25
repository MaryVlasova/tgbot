<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorOfNoteCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors_of_note_category')->insert([
            [
                'name' => 'Черный',
                'code' => 'dark',
            ],
            [
                'name' => 'Красный',
                'code' => 'danger',
            ],
            [
                'name' => 'Синий',
                'code' => 'primary',
            ],
            [
                'name' => 'Серый',
                'code' => 'secondary',
            ],            
            [
                'name' => 'Зеленый',
                'code' => 'success',
            ],            
        ]); 
    }
}
