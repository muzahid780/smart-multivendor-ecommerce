@extends('frontend.master')

@section('title', 'Edit Profile')

@section('content')

<div class="min-h-[calc(100vh-64px)] flex">

    <!-- LEFT SIDE -->
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-600 to-emerald-500 items-center justify-center p-10">

        <div class="text-white max-w-md">

            <h1 class="text-5xl font-bold mb-6">
                My Profile
            </h1>

            <p class="text-lg mb-6">
                Edit your profile information and keep your ShopNest account up to date.
            </p>

            <img 
                 src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=800&q=80"
                 class="w-full h-[350px] object-cover rounded-xl"
                  alt="Profile"
                />
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-10">

        <div class="bg-white w-full max-w-md p-10 rounded-2xl shadow-2xl">

            <h2 class="text-3xl font-bold text-center text-green-600 mb-2">
                Edit Profile
            </h2>

            <p class="text-center text-gray-500 mb-8">
                Update your account information below.
            </p>

            @if ($errors->any())
                <div class="mb-5 bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('status') === 'profile-updated')
                <div class="mb-5 bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg">
                    ✔ Profile updated successfully.
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label class="block mb-2 font-medium">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300"
                        required
                        autofocus
                        autocomplete="name">

                    @error('name')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label class="block mb-2 font-medium">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300"
                        required
                        autocomplete="username">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Update Button -->
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition font-semibold">

                    Update Profile

                </button>

            </form>

            <div class="text-center mt-6">

                <a href="{{ route('password.request') }}"
                   class="text-green-600 hover:underline text-sm">
                    Change Password
                </a>

            </div>

        </div>

    </div>

</div>

@endsection