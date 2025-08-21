<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    // Admin: list sliders
    public function index() {
        $sliders = Slider::paginate(3);
        return view('admin.slider.index', compact('sliders'));
    }

    // Show create form
    public function create() {
        return view('admin.slider.create');
    }

    // Store slider
    public function store(Request $request) {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ta' => 'nullable|string|max:255',
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'desc_en' => 'nullable|string',
            'desc_ta' => 'nullable|string',
            'is_public' => 'nullable|boolean',
        ]);

        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/sliders', 'public');
                $imageUrls[] = asset('storage/' . $path);
            }
        }

        Slider::create([
            'title_en' => $request->title_en,
            'title_ta' => $request->title_ta,
            'images' => $imageUrls,
            'desc_en' => $request->desc_en,
            'desc_ta' => $request->desc_ta,
            'is_public' => $request->has('is_public') ? 1 : 0,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider added successfully!');
    }

    // Show edit form
public function edit(Slider $slider) {
    return view('admin.slider.edit', compact('slider'));
}

// Update slider
public function update(Request $request, Slider $slider) {
    $request->validate([
        'title_en' => 'required|string|max:255',
        'title_ta' => 'nullable|string|max:255',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'desc_en' => 'nullable|string',
        'desc_ta' => 'nullable|string',
        'is_public' => 'nullable|boolean',
    ]);

    $imageUrls = $slider->images ?? [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('uploads/sliders', 'public');
            $imageUrls[] = asset('storage/' . $path);
        }
    }

    $slider->update([
        'title_en' => $request->title_en,
        'title_ta' => $request->title_ta,
        'images' => $imageUrls,
        'desc_en' => $request->desc_en,
        'desc_ta' => $request->desc_ta,
        'is_public' => $request->has('is_public') ? 1 : 0,
    ]);

    return redirect()->route('slider.index')->with('success', 'Slider updated successfully!');
}



// Public sliders as JSON API
public function public()
{
    $sliders = Slider::where('is_public', 1)->get();

    return response()->json([
        'success' => true,
        'data' => $sliders
    ], 200, [
        'Access-Control-Allow-Origin' => '*',   // 👈 allow all origins
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
}

}
