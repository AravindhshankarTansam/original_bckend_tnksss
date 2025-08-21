@extends('layouts.app')

@section('title', 'Slider List')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Sliders</h2>
<a href="{{ route('admin.slider.create') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg">
    Add New Slider
</a>

    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg border border-gray-200">
            <thead>
                <tr class="bg-blue-100 text-left">
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Title (EN)</th>
                    <th class="px-4 py-2 border-b">Title (TA)</th>
                    <th class="px-4 py-2 border-b">Images</th>
                    <th class="px-4 py-2 border-b">Description (EN)</th>
                    <th class="px-4 py-2 border-b">Description (TA)</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
<tbody>
@forelse($sliders as $index => $slider)
<tr class="hover:bg-gray-50 text-sm">
    <!-- Index -->
    <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>

    <!-- Title EN -->
    <td class="px-4 py-2 border-b break-words max-w-xs">
        {{ $slider->title_en }}
    </td>

    <!-- Title TA -->
    <td class="px-4 py-2 border-b break-words max-w-xs">
        {{ $slider->title_ta }}
    </td>

    <!-- Images -->
    <td class="px-4 py-2 border-b flex flex-wrap">
        @if($slider->images)
            @foreach($slider->images as $image)
                <img src="{{ $image }}" class="w-16 h-16 rounded object-cover mr-2 mb-2">
            @endforeach
        @endif
    </td>

<!-- Description EN -->
<td class="px-4 py-2 border-b break-words max-w-xs">
    {!! $slider->desc_en !!}
</td>

<!-- Description TA -->
<td class="px-4 py-2 border-b break-words max-w-xs">
    {!! $slider->desc_ta !!}
</td>

<!-- Status Column (before Actions) -->
<td class="px-4 py-2 border-b text-center">
    @if($slider->is_public)
        <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">Active</span>
    @else
        <span class="px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">Inactive</span>
    @endif
</td>

<!-- Actions Column -->
<td class="px-4 py-2 border-b text-center">
    <!-- Edit button -->
    <a href="{{ route('admin.slider.edit', $slider->id) }}" 
        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium">
        Edit
    </a>
</td>

</tr>
@empty
<tr>
    <td colspan="7" class="px-4 py-2 text-center text-gray-500">No sliders found.</td>
</tr>
@endforelse
</tbody>

        </table>
        <div class="mt-4">
            {{ $sliders->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

@endsection
