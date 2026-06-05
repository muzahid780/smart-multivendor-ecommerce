@extends('layouts.admin')
@section('title', 'Categories')
@section('page-title', 'Categories List')
@section('content')
<div class="bg-white p-6 rounded-2xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">All Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">
            + Add Category
        </a>
    </div>

    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left border">ID</th>
                <th class="p-3 text-left border">Name</th>
                <th class="p-3 text-left border">Created At</th>
                <th class="p-3 text-center border">Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse($categories as $category)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3 border">
                        {{ $category->id }}
                    </td>
                    <td class="p-3 border font-medium">
                        {{ $category->name }}
                    </td>
                    <td class="p-3 border text-sm text-gray-500">
                        {{ $category->created_at->format('d M Y') }}
                    </td>
                    <td class="p-3 border text-center">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="text-blue-600 hover:underline mr-3">
                            Edit
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:underline"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">
                        No categories found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection