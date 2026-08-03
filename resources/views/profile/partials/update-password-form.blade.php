<section>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-6">
            <h3 class="text-xl font-bold text-gray-800">
                Change Password
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Use a strong password to keep your account secure.
            </p>
        </div>

        <!-- Current Password -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Current Password
            </label>

            <input
                type="password"
                name="current_password"
                autocomplete="current-password"
                placeholder="Enter current password"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300">

            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                New Password
            </label>

            <input
                type="password"
                name="password"
                autocomplete="new-password"
                placeholder="Enter new password"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300">

            @error('password', 'updatePassword')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Confirm New Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                placeholder="Confirm new password"
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-300">

            @error('password_confirmation', 'updatePassword')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition">
            Update Password
        </button>

        @if(session('status') === 'password-updated')
            <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-lg text-center text-sm">
                ✔ Password updated successfully.
            </div>
        @endif

    </form>

</section>