<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //User::factory()->count(1)->create();
        //Post::factory()->count(1)->create();

        //Default Admin User
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin$123'),
                'profile' => 'pyaephyothet.jpeg',
                'role' => '0',
                'phone' => '09755025343',
                'address' => 'Yangon, Botadaung Pagoda Road',
                'dob' => '1996-11-8',
                'create_user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

    }

}