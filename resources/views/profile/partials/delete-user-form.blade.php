<section>

    <!-- Heading -->
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-red-600">
            Delete Account
        </h3>

        <p class="text-gray-500 mt-2">
            Permanently delete your ShopNest account.
        </p>
    </div>

    <!-- Warning -->
    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">

        <div class="flex items-start gap-3">

            <div class="text-2xl">
                ⚠️
            </div>

            <div>

                <h4 class="font-semibold text-red-700">
                    Warning
                </h4>

                <p class="text-sm text-red-600 mt-1">
                    Once your account is deleted, all your profile,
                    orders, wishlist and personal information will be
                    permanently removed. This action cannot be undone.
                </p>

            </div>

        </div>

    </div>

    <!-- Delete Button -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">

        Delete Account

    </button>

    <!-- Modal -->
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form method="POST"
              action="{{ route('profile.destroy') }}"
              class="p-8">

            @csrf
            @method('DELETE')

            <h2 class="text-2xl font-bold text-red-600 mb-2">
                Confirm Delete
            </h2>

            <p class="text-gray-600 mb-6">
                Enter your password to permanently delete your account.
            </p>

            <div class="mb-6">

                <label class="block mb-2 font-medium">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-300">

                @error('password', 'userDeletion')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-6 py-2 border rounded-lg hover:bg-gray-100">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">

                    Delete

                </button>

            </div>

        </form>

    </x-modal>

</section>