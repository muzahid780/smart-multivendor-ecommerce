<section>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Title -->
        <div class="mb-6 text-center">
            <h3 class="text-2xl font-bold text-green-600">
                Profile Information
            </h3>

            <p class="text-gray-500 mt-2">
                Update your account details.
            </p>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-2 font-medium">
                Full Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300">

            @error('name')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label class="block mb-2 font-medium">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300">

            @error('email')
                <p class="text-red-500 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 text-sm">
                    <span class="text-red-500">
                        Your email is not verified.
                    </span>

                    <button
                        type="submit"
                        form="send-verification"
                        class="ml-2 text-green-600 hover:underline font-medium">
                        Resend Verification
                    </button>
                </div>

                @if(session('status') === 'verification-link-sent')
                    <p class="text-green-600 text-sm mt-2">
                        Verification email has been sent.
                    </p>
                @endif

            @endif
        </div>

        <!-- Button -->
        <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition">
            Update Profile
        </button>

        @if(session('status') === 'profile-updated')

            <p class="text-center text-green-600 mt-4 font-medium">
                ✔ Profile updated successfully.
            </p>

        @endif

    </form>

</section>