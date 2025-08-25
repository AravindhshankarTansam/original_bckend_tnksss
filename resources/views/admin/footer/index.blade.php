@extends('layouts.app')
@section('title', 'Footer List')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Footers List</h2>
        <a href="{{ route('admin.footer.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add Footer</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <!-- Only table scrolls -->
    <div class="overflow-auto border rounded" style="max-height:600px;">
        <table class="min-w-full bg-white border">
            <thead class="sticky top-0 bg-gray-200 z-10">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Description EN</th>
                    <th class="border px-4 py-2">Description TA</th>
                    <th class="border px-4 py-2">Facebook</th>
                    <th class="border px-4 py-2">Twitter</th>
                    <th class="border px-4 py-2">Instagram</th>
                    <th class="border px-4 py-2">Headers & Links</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($footers as $footer)
                <tr class="bg-white">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">
                        @if($footer->image)
                            <img src="{{ asset('storage/'.$footer->image) }}" class="w-20 h-20 object-cover rounded">
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $footer->description_en }}</td>
                    <td class="border px-4 py-2">{{ $footer->description_ta }}</td>
                    <td class="border px-4 py-2">{{ $footer->facebook }}</td>
                    <td class="border px-4 py-2">{{ $footer->twitter }}</td>
                    <td class="border px-4 py-2">{{ $footer->instagram }}</td>
                    <td class="border px-4 py-2">
                        @for($h=1; $h<=3; $h++)
                            <div class="mb-2">
                                <strong>Header {{ $h }} EN:</strong> {{ $footer["header{$h}_en"] }}<br>
                                <strong>Header {{ $h }} TA:</strong> {{ $footer["header{$h}_ta"] }}<br>
                                @for($l=1; $l<=4; $l++)
                                    <div class="ml-4 mb-1 bg-gray-50 p-1 rounded">
                                        <strong>Link {{ $l }} EN:</strong> {{ $footer["header{$h}_link{$l}_en"] ?? '-' }}<br>
                                        <strong>Link {{ $l }} TA:</strong> {{ $footer["header{$h}_link{$l}_ta"] ?? '-' }}<br>
                                        <strong>URL:</strong> 
                                        @if(!empty($footer["header{$h}_link{$l}_url"]))
                                            <a href="{{ $footer["header{$h}_link{$l}_url"] }}" target="_blank" class="text-blue-600 underline">{{ $footer["header{$h}_link{$l}_url"] }}</a>
                                        @else - @endif
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </td>
                    <td class="border px-4 py-2">{{ $footer->is_public ? 'Active' : 'Inactive' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.footer.edit', $footer->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $footers->links() }}
    </div>
</div>
@endsection
