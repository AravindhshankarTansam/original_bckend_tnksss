<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroText;

class HeroTextController extends Controller
{
    // Admin index
    public function index()
    {
        $hero_texts = HeroText::latest()->paginate(10);
        return view('admin.hero.index', compact('hero_texts'));
    }

    // Admin create
    public function create()
    {
        return view('admin.hero.create');
    }

    // Admin store
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'required|string',
            'description_en' => 'required|string',
            'description_ta' => 'required|string',
            'is_public' => 'nullable|boolean',
        ]);

        HeroText::create($request->all());
        return redirect()->route('admin.hero.index')->with('success', 'Hero text created successfully!');
    }

    // Admin edit
    public function edit(HeroText $heroText)
    {
        return view('admin.hero.edit', compact('heroText'));
    }



    // Admin update
    public function update(Request $request, HeroText $hero)
    {
        $request->validate([
            'title_en' => 'required|string',
            'title_ta' => 'required|string',
            'description_en' => 'required|string',
            'description_ta' => 'required|string',
            'is_public' => 'nullable|boolean',
        ]);

        $hero->update($request->all());
        return redirect()->route('admin.hero.index')->with('success', 'Hero text updated successfully!');
    }

    // Public route
 // Public route returning JSON with CORS headers
    public function public()
    {
        $hero_texts = HeroText::where('is_public', 1)->latest()->get();

        // Transform each hero_text to include full URL for image if exists
        $hero_texts = $hero_texts->map(function ($hero) {
            if (isset($hero->image) && $hero->image) {
                $hero->image = url($hero->image);
            }
            return $hero;
        });

        return response()->json([
            'success' => true,
            'data' => $hero_texts
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
        ]);
    }
}
