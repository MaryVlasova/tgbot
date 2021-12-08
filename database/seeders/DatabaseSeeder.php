<?php

namespace Database\Seeders;

use App\Models\BotSettings;
use App\Models\CategoryNotes;
use App\Models\ColorOfNoteCategory;
use App\Models\Note;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call([     
            BotSettingsSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            ColorOfNoteCategorySeeder::class,
            CategoryNotesSeeder::class,
            NoteSeeder::class 
        ]);      






    }
}
