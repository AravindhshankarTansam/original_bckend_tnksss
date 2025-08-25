@extends('layouts.app')

@section('title', 'Header List')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Headers</h2>
        <a href="{{ route('admin.header.create') }}" 
           class="px-5 py-2 bg-blue-600 text-white rounded-lg">
            Add New Headera
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
                    <th class="px-4 py-2 border-b">Image</th>
                    <th class="px-4 py-2 border-b">Alt (EN)</th>
                    <th class="px-4 py-2 border-b">Alt (TA)</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($headers as $index => $header)
                <tr class="hover:bg-gray-50 text-sm">
                    <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">
                        @if($header->image)
                            <img src="{{ asset('storage/'.$header->image) }}" class="w-20 h-20 rounded object-cover">
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">{{ $header->alt_en }}</td>
                    <td class="px-4 py-2 border-b">{{ $header->alt_ta }}</td>
                    <td class="px-4 py-2 border-b text-center">
                        @if($header->is_public)
                            <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b text-center">
                        <a href="{{ route('admin.header.edit', $header->id) }}" 
                           class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-medium">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No headers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $headers->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
