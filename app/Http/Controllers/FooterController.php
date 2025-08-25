<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $footers = Footer::latest()->paginate(10);
        return view('admin.footer.index', compact('footers'));
    }

    public function create()
    {
        return view('admin.footer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_en' => 'required|string',
            'description_ta' => 'required|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'header1_en' => 'nullable|string',
            'header1_ta' => 'nullable|string',
            'link1' => 'nullable|url',
            'header2_en' => 'nullable|string',
            'header2_ta' => 'nullable|string',
            'link2' => 'nullable|url',
            'header3_en' => 'nullable|string',
            'header3_ta' => 'nullable|string',
            'link3' => 'nullable|url',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('footers', 'public');
        }

        Footer::create($data);

        return redirect()->route('admin.footer.index')->with('success', 'Footer created successfully!');
    }

    public function edit(Footer $footer)
    {
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request, Footer $footer)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($footer->image && Storage::disk('public')->exists($footer->image)) {
                Storage::disk('public')->delete($footer->image);
            }
            $data['image'] = $request->file('image')->store('footers', 'public');
        }

        $footer->update($data);

        return redirect()->route('admin.footer.index')->with('success', 'Footer updated successfully!');
    }

    // Public sliders as JSON API
public function public()
{
    $footers = Footer::where('is_public', 1)->get();

    // Transform each footer to include full URL for the image
    $footers = $footers->map(function ($footer) {
        if ($footer->image) {
            $footer->image = url($footer->image); // full URL
        }
        return $footer;
    });

    return response()->json([
        'success' => true,
        'data' => $footers
    ], 200, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
    ]);
}

}
