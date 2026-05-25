@extends('layouts.admin')

@section('title', 'Users')

@section('page-title', 'Users Management')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <h2 class="text-xl font-bold text-gray-800">
            Admin Users List
        </h2>

        <!-- SEARCH FORM -->
        <form method="GET" class="flex gap-2">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by name or email..."
                   class="border rounded-lg px-4 py-2 w-64">

            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Search
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                Reset
            </a>

        </form>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full border border-gray-200 rounded-lg">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border text-left">ID</th>
                    <th class="p-3 border text-left">Name</th>
                    <th class="p-3 border text-left">Email</th>
                    <th class="p-3 border text-left">Role</th>
                    <th class="p-3 border text-left">Joined</th>
                    <th class="p-3 border text-left">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr class="hover:bg-gray-50">

                        <td class="p-3 border">{{ $user->id }}</td>

                        <td class="p-3 border font-medium">
                            {{ $user->name }}
                        </td>

                        <td class="p-3 border">
                            {{ $user->email }}
                        </td>

                        <td class="p-3 border">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : '' }}
                                {{ $user->role === 'vendor' ? 'bg-blue-100 text-blue-600' : '' }}
                                {{ $user->role === 'customer' ? 'bg-green-100 text-green-600' : '' }}
                            ">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td class="p-3 border text-sm text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="p-3 border">

                            <!-- SAFE DELETE -->
                            @if($user->id !== auth()->id())

                                <form method="POST"
                                      action="{{ route('admin.users.delete', $user->id) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this user?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>

                                </form>

                            @else
                                <span class="text-gray-400 text-sm">Current User</span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            No users found
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection