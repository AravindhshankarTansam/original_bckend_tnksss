@extends('layouts.app')
@section('title', 'Gallery List')
@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📸 Gallery List</h2>
        <a href="{{ route('admin.gallery.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition">
           Add New
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Title (EN)</th>
                    <th class="px-4 py-2">Title (TA)</th>
                    <th class="px-4 py-2">Description (EN)</th>
                    <th class="px-4 py-2">Description (TA)</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Publish Date</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galleries as $gallery)
                <tr class="text-center border-b align-top">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $gallery->title_en }}</td>
                    <td class="px-4 py-2">{{ $gallery->title_ta }}</td>
                    <td class="px-4 py-2 text-left">
                        {!! \Illuminate\Support\Str::limit(strip_tags($gallery->description_en), 100) !!}
                    </td>
                    <td class="px-4 py-2 text-left">
                        {!! \Illuminate\Support\Str::limit(strip_tags($gallery->description_ta), 100) !!}
                    </td>
                    <td class="px-4 py-2">
                        @if($gallery->image)
                            <img src="{{ $gallery->image }}" alt="Gallery Image" class="w-20 h-16 object-cover mx-auto rounded">
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $gallery->publish_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        @if($gallery->is_public)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Active</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
