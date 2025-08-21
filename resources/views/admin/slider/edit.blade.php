@extends('layouts.app')
@vite('resources/css/app.css')

@section('title', 'Edit Slider')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Slider</h2>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Title EN -->
            <div>
                <label class="block font-medium text-gray-700">Title (English)</label>
                <input type="text" name="title_en" class="w-full border rounded px-3 py-2" value="{{ $slider->title_en }}" required>
            </div>

            <!-- Title TA -->
            <div>
                <label class="block font-medium text-gray-700">Title (Tamil)</label>
                <input type="text" name="title_ta" class="w-full border rounded px-3 py-2" value="{{ $slider->title_ta }}">
            </div>

            <!-- Images -->
            <div>
                <label class="block font-medium text-gray-700">Images (Upload to add new)</label>
                <input 
                    type="file" 
                    name="images[]" 
                    multiple 
                    accept=".jpg,.jpeg,.png" 
                    class="w-full border rounded px-3 py-2"
                >
                @if($slider->images)
                    <div class="mt-2 flex flex-wrap">
                        @foreach($slider->images as $image)
                            <img src="{{ $image }}" class="w-16 h-16 rounded object-cover mr-1 mb-1 inline-block">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Description EN -->
            <div>
                <label class="block font-medium text-gray-700">Description (English)</label>
                <textarea id="desc_en" name="desc_en" class="w-full border rounded px-3 py-2">{{ $slider->desc_en }}</textarea>
            </div>

            <!-- Description TA -->
            <div>
                <label class="block font-medium text-gray-700">Description (Tamil)</label>
                <textarea id="desc_ta" name="desc_ta" class="w-full border rounded px-3 py-2">{{ $slider->desc_ta }}</textarea>
            </div>

            <!-- Public Slider Toggle -->
<div x-data="{ isPublic: {{ isset($slider) && $slider->is_public ? 'true' : 'false' }} }" class="flex items-center space-x-3">
    <label class="inline-flex relative items-center cursor-pointer">
        <input 
            type="checkbox" 
            name="is_public" 
            value="1" 
            class="sr-only peer"
            x-model="isPublic"
        >
        <div class="w-12 h-6 bg-gray-300 rounded-full peer-checked:bg-green-500 
                    relative after:content-[''] after:absolute after:left-1 after:top-1 
                    after:w-4 after:h-4 after:bg-white after:rounded-full after:transition-all 
                    peer-checked:after:translate-x-6">
        </div>
    </label>
    <span class="font-medium text-gray-700" x-text="isPublic ? 'Active' : 'Inactive'"></span>
</div>


            <!-- Buttons -->
            <div class="flex justify-between mt-4">
                <a href="{{ route('slider.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    Update Slider
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#desc_en')).catch(error => console.error(error));
ClassicEditor.create(document.querySelector('#desc_ta')).catch(error => console.error(error));
</script>
@endsection
