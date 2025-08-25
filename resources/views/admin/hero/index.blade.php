@extends('layouts.app')
@section('title', 'Hero Text List')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Hero Texts List</h2>
        <a href="{{ route('admin.hero.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add Hero Text</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <!-- Scrollable table -->
    <div class="overflow-x-auto max-h-[600px]">
        <table class="min-w-full bg-white border">
            <thead class="sticky top-0 bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Title (EN)</th>
                    <th class="border px-4 py-2">Title (TA)</th>
                    <th class="border px-4 py-2">Description (EN)</th>
                    <th class="border px-4 py-2">Description (TA)</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hero_texts as $hero)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $hero->title_en }}</td>
                    <td class="border px-4 py-2">{{ $hero->title_ta }}</td>
                    <td class="border px-4 py-2">{{ $hero->description_en }}</td>
                    <td class="border px-4 py-2">{{ $hero->description_ta }}</td>
                    <td class="border px-4 py-2">{{ $hero->is_public ? 'Active' : 'Inactive' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.hero.edit', $hero->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $hero_texts->links() }}
    </div>
</div>
@endsection
