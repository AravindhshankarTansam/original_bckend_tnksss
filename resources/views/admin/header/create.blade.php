@extends('layouts.app')

@section('title', 'Create Header')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Header</h2>

    <form action="{{ route('admin.header.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf

        <!-- Image Upload -->
        <div>
            <label class="block text-gray-700 font-medium">Header Image</label>
            <input type="file" name="image" 
                   class="mt-2 block w-full border p-2 rounded @error('image') border-red-500 @enderror">
            @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Alt Text EN -->
        <div>
            <label class="block text-gray-700 font-medium">Alt Text (English)</label>
            <input type="text" name="alt_en" value="{{ old('alt_en') }}"
                   class="mt-2 block w-full border p-2 rounded @error('alt_en') border-red-500 @enderror">
            @error('alt_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Alt Text TA -->
        <div>
            <label class="block text-gray-700 font-medium">Alt Text (Tamil)</label>
            <input type="text" name="alt_ta" value="{{ old('alt_ta') }}"
                   class="mt-2 block w-full border p-2 rounded @error('alt_ta') border-red-500 @enderror">
            @error('alt_ta') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-700 font-medium">Status</label>
            <select name="is_public" class="mt-2 block w-full border p-2 rounded">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Save
            </button>
            <a href="{{ route('admin.header.index') }}" 
               class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
