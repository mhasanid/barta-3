<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $users = DB::table('users')->get();

        // // Iterate over each user and insert fake data for their profile
        // foreach ($users as $user) {
        //     DB::table('user_profiles')->insert([
        //         'user_id' => $user->id, // Reference the existing user_id
        //         'bio' => fake()->paragraph, // Generate a fake bio
        //         'profile_picture' => "https://randomuser.me/api/portraits/med/men/".$user->id.".jpg", // Generate fake image file name
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
