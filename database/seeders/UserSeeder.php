<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // for ($i=0; $i < 20; $i++) { 
        //     DB::table('users')->insert([
        //         'firstname' => fake()->firstName(),
        //         'lastname' => fake()->lastName(),
        //         'username' => fake()->userName(),
        //         'email' => fake()->unique()->safeEmail(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        User::factory()
            ->count(50)
            ->hasPosts(1)
            ->hasUserProfile(1)
            ->create();
    }
}
