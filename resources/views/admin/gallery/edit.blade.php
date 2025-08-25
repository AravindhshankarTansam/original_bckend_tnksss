@extends('layouts.app')

@section('title', 'Edit Gallery')

@section('content')
<div class="container mx-auto mt-10 max-w-3xl">
    <h2 class="text-2xl font-bold mb-6">📸 Edit Gallery</h2>

    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf
        @method('PUT')

        <!-- Title EN -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Title (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $gallery->title_en) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Title TA -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Title (TA)</label>
            <input type="text" name="title_ta" value="{{ old('title_ta', $gallery->title_ta) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Description EN -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Description (EN)</label>
            <textarea id="desc_en" name="description_en" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('description_en', $gallery->description_en) }}</textarea>
        </div>

        <!-- Description TA -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Description (TA)</label>
            <textarea id="desc_ta" name="description_ta" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('description_ta', $gallery->description_ta) }}</textarea>
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            @if($gallery->image)
                <img src="{{ $gallery->image }}" alt="Gallery Image" class="w-32 h-24 object-cover mt-2 rounded">
            @endif
        </div>

        <!-- Publish Date -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Publish Date</label>
            <input type="date" name="publish_date" value="{{ old('publish_date', $gallery->publish_date->format('Y-m-d')) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Active Checkbox -->
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_public" value="1" {{ $gallery->is_public ? 'checked' : '' }}
                       class="form-checkbox">
                <span class="ml-2">Active</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center space-x-4 mb-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                Update
            </button>
            <a href="{{ route('admin.gallery.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
let editorEN, editorTA;

ClassicEditor.create(document.querySelector('#desc_en'))
    .then(editor => editorEN = editor)
    .catch(error => console.error(error));

ClassicEditor.create(document.querySelector('#desc_ta'))
    .then(editor => editorTA = editor)
    .catch(error => console.error(error));

// Client-side validation
document.getElementById('galleryForm').addEventListener('submit', function(e) {
    if (!editorEN.getData().trim()) {
        e.preventDefault();
        alert('Description (EN) is required!');
        editorEN.editing.view.focus();
    }
});
</script>
@endsection
