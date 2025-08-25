@extends('layouts.app')
@section('title', 'Edit Hero Text')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h2 class="text-2xl font-bold mb-6">Edit Hero Text</h2>

    <form action="{{ route('admin.hero.update', $heroText->id) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Title (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $heroText->title_en) }}" class="mt-2 block w-full border p-2 rounded">
        </div>

        <div>
            <label>Title (TA)</label>
            <input type="text" name="title_ta" value="{{ old('title_ta', $heroText->title_ta) }}" class="mt-2 block w-full border p-2 rounded">
        </div>

        <div>
            <label>Description (EN)</label>
            <textarea id="desc_en" name="description_en" class="mt-2 block w-full border p-2 rounded">{{ old('description_en', $heroText->description_en) }}</textarea>
        </div>

        <div>
            <label>Description (TA)</label>
            <textarea id="desc_ta" name="description_ta" class="mt-2 block w-full border p-2 rounded">{{ old('description_ta', $heroText->description_ta) }}</textarea>
        </div>

        <!-- Toggle switch for Active / Inactive -->
        <div class="flex items-center space-x-2 mt-2">
            <label class="font-medium text-gray-700">Publish</label>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="1" name="is_public" class="sr-only peer" {{ $heroText->is_public ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-600
                            after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white
                            after:border after:border-gray-300 after:rounded-full after:h-5 after:w-5
                            after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white">
                </div>
            </label>
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded">Update</button>
            <a href="{{ route('admin.hero.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded">Cancel</a>
        </div>
    </form>
</div>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#desc_en')).catch(error => console.error(error));
ClassicEditor.create(document.querySelector('#desc_ta')).catch(error => console.error(error));
</script>
@endsection
