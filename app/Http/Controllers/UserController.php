<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function viewDashboard()
    {
        return $this->getUserView('profile.dashboard');
    }

    public function viewProfile()
    {
        $user = $this->getUserWithProfile();
        if (!$user) {
            return redirect()->route('login');
        }
        $posts = Post::with('user')
                        ->where('user_id', $user->id)
                        ->get();

        return view('profile.view', compact('user', 'posts'));
    }

    public function viewUserProfile(string $id)
    {
        $loggedin_user = $this->getUserWithProfile();
        if (!$loggedin_user) {
            return redirect()->route('login');
        }
        $posts = Post::with('user')
                        ->where('user_id', $id)
                        ->get();

        $user = User::find($id); 
        return view('profile.view', compact('user', 'posts'));
    }

    public function editProfile()
    {
        return $this->getUserView('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = $this->getProfileValidator($request, $user);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $validated = $validator->validated();

        
        
        if ($request->hasFile('avatar')) {

            $oldAvatar = $user->userProfile->avatar;
            if ($oldAvatar && Storage::disk('public')->exists('avatars/' . $oldAvatar)) {
                Storage::disk('public')->delete('avatars/' . $oldAvatar); // Delete the old avatar
            }

            $avatar = $request->file('avatar');
            $avatarName = $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension(); 
            $avatar->storeAs('avatars', $avatarName, 'public'); 
            
            $validated['avatar'] = $avatarName;
            // $user->userProfile->avatar = $avatarName;
            // $user->userProfile->save();
        }
        
        // dd($validated);
        try {
            $this->userRepository->updateUser($user->id, $validated);
            $this->userRepository->updateUserProfile($user->id, $validated);

            return redirect()->route('profile.view')->with('status', 'Profile updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['db_fails' => 'Something went wrong, failed to update your profile!']);
        }
    }

    private function getProfileValidator(Request $request, $user)
    {
        return Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|in:' . $user->email,
            'password' => 'nullable|string|min:8',
            'newpassword' => 'nullable|required_with:password|string|min:8',
            'avatar'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:255',
        ], [
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'email.in' => 'Email cannot be changed.',
            'password.min' => 'Password must be at least 8 characters long.',
            'newpassword.min' => 'New password must be at least 8 characters long.',
            'newpassword.required_with' => 'To change the password, please enter your current password.',
        ]);
    }

    private function getUserView($viewName)
    {
        $user = $this->getUserWithProfile();
        if (!$user) {
            return redirect()->route('login');
        }
        return view($viewName, compact('user'));
    }

    private function getUserWithProfile()
    {
        return $this->userRepository->getUserWithProfile(Auth::id());
    }

}
