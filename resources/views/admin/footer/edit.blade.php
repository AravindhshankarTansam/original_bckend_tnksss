@extends('layouts.app')
@section('title', 'Edit Footer')
@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h2 class="text-2xl font-bold mb-6">Edit Footer</h2>

    <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Footer Image</label>
            <input type="file" name="image" class="mt-2 block w-full border p-2 rounded">
            @if($footer->image)
                <img src="{{ asset('storage/'.$footer->image) }}" class="w-32 h-32 mt-2 rounded object-cover">
            @endif
        </div>

        <div>
            <label>Description (EN)</label>
            <textarea name="description_en" class="mt-2 block w-full border p-2 rounded">{{ $footer->description_en }}</textarea>
        </div>

        <div>
            <label>Description (TA)</label>
            <textarea name="description_ta" class="mt-2 block w-full border p-2 rounded">{{ $footer->description_ta }}</textarea>
        </div>

        <div>
            <label>Facebook</label>
            <input type="url" name="facebook" value="{{ $footer->facebook }}" class="mt-2 block w-full border p-2 rounded">
        </div>
        <div>
            <label>Twitter</label>
            <input type="url" name="twitter" value="{{ $footer->twitter }}" class="mt-2 block w-full border p-2 rounded">
        </div>
        <div>
            <label>Instagram</label>
            <input type="url" name="instagram" value="{{ $footer->instagram }}" class="mt-2 block w-full border p-2 rounded">
        </div>

        @for($h=1;$h<=3;$h++)
        <div class="border p-4 rounded mb-4">
            <h3 class="font-medium mb-2">Header {{ $h }}</h3>

            <label>Header Title (EN)</label>
            <input type="text" name="header{{ $h }}_en" value="{{ $footer->{'header'.$h.'_en'} }}" class="mt-1 block w-full border p-2 rounded">

            <label>Header Title (TA)</label>
            <input type="text" name="header{{ $h }}_ta" value="{{ $footer->{'header'.$h.'_ta'} }}" class="mt-1 block w-full border p-2 rounded">

            @for($l=1;$l<=4;$l++)
            <div class="mt-2 border p-2 rounded bg-gray-50">
                <label>Link {{ $l }} Title (EN)</label>
                <input type="text" name="header{{ $h }}_link{{ $l }}_en" value="{{ $footer->{'header'.$h.'_link'.$l.'_en'} }}" class="mt-1 block w-full border p-2 rounded">

                <label>Link {{ $l }} Title (TA)</label>
                <input type="text" name="header{{ $h }}_link{{ $l }}_ta" value="{{ $footer->{'header'.$h.'_link'.$l.'_ta'} }}" class="mt-1 block w-full border p-2 rounded">

                <label>Link {{ $l }} URL</label>
                <input type="url" name="header{{ $h }}_link{{ $l }}_url" value="{{ $footer->{'header'.$h.'_link'.$l.'_url'} }}" class="mt-1 block w-full border p-2 rounded">
            </div>
            @endfor
        </div>
        @endfor

        <div>
            <label>Status</label>
            <select name="is_public" class="mt-2 block w-full border p-2 rounded">
                <option value="1" {{ $footer->is_public ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$footer->is_public ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded">Update</button>
            <a href="{{ route('admin.footer.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
