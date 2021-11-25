<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => 'Maria',
            'email' =>  env('TEST_USER_EMAIL', 'TEST_USER_EMAIL'),
            'password' => Hash::make(env('TEST_USER_PASSWORD', 'TEST_USER_PASSWORD'))
        ]);

    }
}
