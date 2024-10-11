@extends('layouts.app')

@section('title', 'Edit Profile - Barta App')

@section('content')
    <!-- Profile Edit Form -->
    <form
      action="{{route('profile.update')}}"
      method="POST"
      enctype="multipart/form-data">
      
      @csrf
      @method('PATCH')
      <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
          <h2 class="text-xl font-semibold leading-7 text-gray-900">
            Edit Profile
          </h2>
          <p class="mt-1 text-sm leading-6 text-gray-600">
            This information will be displayed publicly so be careful what you
            share.
          </p>

          @error('db_fails')
              <div class="mt-8 text-sm leading-6 text-red-500">
                  {{ $message }}
              </div>
          @enderror

          <div class="mt-10 border-b border-gray-900/10 pb-12">
            <div class="col-span-full mt-10 pb-10">
              <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
              <div class="mt-2 flex items-center gap-x-3">
                <input class="hidden" type="file" name="avatar" id="avatar" onchange="showFileName()">
                <img class="h-32 w-32 rounded-full" src="{{ isset($user->userProfile->avatar) ? asset('/storage/avatars/' . $user->userProfile->avatar) : 'https://randomuser.me/api/portraits/med/men/' . $user->id . '.jpg' }}" alt="{{$user->firstname}}">
                <label for="avatar">
                  <div class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Change
                  </div>
                </label>
                <span id="file-name" class="text-sm text-gray-600 ml-4"></span>
              </div>
              <script>
                function showFileName() {
                  const input = document.getElementById('avatar');
                  const fileName = input.files[0]?.name || 'No file chosen'; 
                  document.getElementById('file-name').textContent = fileName; 
                }
              </script>
              @error('avatar')
                <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
              @enderror
            </div>
            
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-2">
                  <input type="text" name="firstname" id="firstname" autocomplete="given-name" value="{{$user->firstname}}" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                </div>
                @error('firstname')
                  <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
                @enderror
              </div>

              <div class="sm:col-span-3">
                <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                <div class="mt-2">
                  <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}" autocomplete="family-name" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                </div>
                @error('lastname')
                  <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-span-full">
                  <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                  <input id="email" name="email" type="email" autocomplete="email" value="{{$user->email}}" readonly class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                </div>
                @error('email')
                  <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-span-full">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Current Password</label>
                <div class="mt-2">
                  <input type="password" name="password" id="password" autocomplete="password" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                </div>
                @error('password')
                  <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-span-full">
                <label for="newpassword" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
                <div class="mt-2">
                  <input type="newpassword" name="newpassword" id="newpassword" autocomplete="newpassword" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                </div>
                @error('newpassword')
                  <span class="mt-3 block text-left text-sm font-small leading-6 text-red-500">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
              <div class="mt-2">
                <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{$user->userProfile->bio ?? 'Hello! I am '. $user->firstname .' '. $user->lastname . '.'}}</textarea>
              </div>
              <p class="mt-3 text-sm leading-6 text-gray-600">
                Write a few sentences about yourself.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900" onclick="goBack()">
          Cancel
        </button>
        <script>
          function goBack() {
                window.history.back(); // Navigate to the previous page in the browser history
            }
        </script>
        <button type="submit" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
          Save
        </button>
      </div>
    </form>
    <!-- /Profile Edit Form -->
@endsection