<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            [
                'name' => 'Администратор',
                'slug' => 'admin',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Менеджер',
                'slug' => 'manager',
                'created_at' => Carbon::now(),                
            ],
            [
                'name' => 'Читатель',
                'slug' => 'reader',
                'created_at' => Carbon::now(),                
            ]
        ]);
                
    
    }
}
