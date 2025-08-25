<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Admin: List all galleries
    public function index() {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
    }

    // Admin: Show create form
    public function create() {
        return view('admin.gallery.create');
    }

    // Admin: Store new gallery
    public function store(Request $request) {
        $data = $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'nullable|string',
            'description_en' => 'required|string',
            'description_ta' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|date',
            'is_public' => 'nullable|boolean'
        ]);

        $data['is_public'] = $request->has('is_public') ? 1 : 0;

        // Upload image and get public URL
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $data['image'] = Storage::url($path); // Returns /storage/filename
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Gallery created successfully!');
    }

    // Admin: Show edit form
    public function edit(Gallery $gallery) {
        return view('admin.gallery.edit', compact('gallery'));
    }

    // Admin: Update gallery
    public function update(Request $request, Gallery $gallery) {
        $data = $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'nullable|string',
            'description_en' => 'required|string',
            'description_ta' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|date',
            'is_public' => 'nullable|boolean'
        ]);

        $data['is_public'] = $request->has('is_public') ? 1 : 0;

        // Upload new image if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $data['image'] = Storage::url($path);
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Gallery updated successfully!');
    }

    // Public API
public function public() {
    $galleries = Gallery::where('is_public', true)->get();

    // Transform each gallery to include full URL for the image if it exists
    $galleries = $galleries->map(function ($item) {
        if (isset($item->image) && $item->image) {
            $item->image = url($item->image);
        }
        return $item;
    });

    return response()->json([
        'success' => true,
        'data' => $galleries
    ], 200, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
}

}
