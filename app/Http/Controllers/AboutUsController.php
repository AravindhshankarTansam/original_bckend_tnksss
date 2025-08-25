<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    // Admin index
    public function index()
    {
        $about_us = AboutUs::latest()->paginate(10);
        return view('admin.about.index', compact('about_us'));
    }

    // Admin create
    public function create()
    {
        return view('admin.about.create');
    }

    // Admin store
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'required|string',
            'description_en' => 'required|string',
            'description_ta' => 'required|string',
        ]);

        $data = $request->all();
        $data['is_public'] = $request->has('is_public') ? 1 : 0;

        AboutUs::create($data);

        return redirect()->route('admin.about.index')->with('success', 'About Us created successfully!');
    }

    // Admin edit
    public function edit(AboutUs $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    // Admin update
    public function update(Request $request, AboutUs $about)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'required|string',
            'description_en' => 'required|string',
            'description_ta' => 'required|string',
        ]);

        $data = $request->all();
        $data['is_public'] = $request->has('is_public') ? 1 : 0;

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About Us updated successfully!');
    }

    // Public route
public function public()
{
    $about_us = AboutUs::where('is_public', 1)->latest()->get();

    // Transform each record to include full URL for the image if it exists
    $about_us = $about_us->map(function ($item) {
        if (isset($item->image) && $item->image) {
            $item->image = url($item->image);
        }
        return $item;
    });

    return response()->json([
        'success' => true,
        'data' => $about_us
    ], 200, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
}

}
