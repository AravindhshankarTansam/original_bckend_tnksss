@extends('layouts.app')
@section('title', 'Create Footer')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h2 class="text-2xl font-bold mb-6">Add New Footer</h2>

    <form action="{{ route('admin.footer.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
        @csrf

        <div>
            <label>Footer Image</label>
            <input type="file" name="image" class="mt-2 block w-full border p-2 rounded">
        </div>

        <div>
            <label>Description (EN)</label>
            <textarea name="description_en" class="mt-2 block w-full border p-2 rounded">{{ old('description_en') }}</textarea>
        </div>

        <div>
            <label>Description (TA)</label>
            <textarea name="description_ta" class="mt-2 block w-full border p-2 rounded">{{ old('description_ta') }}</textarea>
        </div>

        <div>
            <label>Facebook</label>
            <input type="url" name="facebook" class="mt-2 block w-full border p-2 rounded">
        </div>
        <div>
            <label>Twitter</label>
            <input type="url" name="twitter" class="mt-2 block w-full border p-2 rounded">
        </div>
        <div>
            <label>Instagram</label>
            <input type="url" name="instagram" class="mt-2 block w-full border p-2 rounded">
        </div>

        @for($h=1;$h<=3;$h++)
        <div class="border p-4 rounded mb-4">
            <h3 class="font-medium mb-2">Header {{ $h }}</h3>

            <label>Header Title (EN)</label>
            <input type="text" name="header{{ $h }}_en" class="mt-1 block w-full border p-2 rounded">

            <label>Header Title (TA)</label>
            <input type="text" name="header{{ $h }}_ta" class="mt-1 block w-full border p-2 rounded">

            @for($l=1;$l<=4;$l++)
            <div class="mt-2 border p-2 rounded bg-gray-50">
                <label>Link {{ $l }} Title (EN)</label>
                <input type="text" name="header{{ $h }}_link{{ $l }}_en" class="mt-1 block w-full border p-2 rounded">

                <label>Link {{ $l }} Title (TA)</label>
                <input type="text" name="header{{ $h }}_link{{ $l }}_ta" class="mt-1 block w-full border p-2 rounded">

                <label>Link {{ $l }} URL</label>
                <input type="url" name="header{{ $h }}_link{{ $l }}_url" class="mt-1 block w-full border p-2 rounded">
            </div>
            @endfor
        </div>
        @endfor

        <div>
            <label>Status</label>
            <select name="is_public" class="mt-2 block w-full border p-2 rounded">
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded">Save</button>
            <a href="{{ route('admin.footer.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
