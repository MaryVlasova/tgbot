<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
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
        ])
        ->each(function ($user) {
            $user->roles()->attach(Role::where('slug','admin')->first());
        });

        User::factory()->count(5)->create([
            'password' => Hash::make(env('TEST_USER_PASSWORD', 'TEST_USER_PASSWORD'))
        ])        
        ->each(function ($user) {
            $user->roles()->attach(Role::orderByRaw("RAND()")->first());
        });
        

    }
}
