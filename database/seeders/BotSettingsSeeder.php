<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BotSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bot_settings')->insert([
            'name' => 'Название бота',
            'description' => 'Описание бота',
            'info' => 'Инфо о боте',
            'token' => 'Токен',
            'link' => 'Ссылка',

        ]); 
    }
}
