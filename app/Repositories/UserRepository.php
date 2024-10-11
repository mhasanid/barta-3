<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserRepository
{
    public function getUserWithProfile($userId)
    {
        $user = User::with('userProfile')
            ->where('id', $userId)
            ->select('users.*')
            ->first();
        
        // dd($user);
        return $user;
    }

    public function updateUser($userId, $data)
    {
        $updatedUserData = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'updated_at' => now(),
        ];

        if (!empty($data['password']) && Hash::check($data['password'], $data['currentPassword'])) {
            $updatedUserData['password'] = Hash::make($data['newpassword']);
        }

        return User::find($userId)->update($updatedUserData);
    }

    public function updateUserProfile($userId, $data)
    {
        // $updatedUserProfileData = [
        //     'bio' => $data['bio'],
        //     'updated_at' => now(),
        // ];

        // $userProfile = DB::table('user_profiles')->where('user_id', $userId)->first();

        // if ($userProfile) {
        //     DB::table('user_profiles')->where('user_id', $userId)->update($updatedUserProfileData);
        // } else {
        //     DB::table('user_profiles')->insert([
        //         ...$updatedUserProfileData,
        //         'created_at' => now(),
        //         'user_id' => $userId,
        //     ]);
        // }
        

        $updatedUserProfileData = [
            'avatar' => $data['avatar'],
            'bio' => $data['bio'],
            'updated_at' => now(),
        ];
        
        UserProfile::updateOrCreate(
            ['user_id' => $userId],
            [
                ...$updatedUserProfileData, 
                'created_at' => now(), 
            ]
        );
    }
}
