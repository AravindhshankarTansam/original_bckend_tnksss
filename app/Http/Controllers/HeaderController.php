<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headers = Header::latest()->paginate(10);
        return view('admin.header.index', compact('headers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.header.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'alt_en' => 'required|string|max:255',
        'alt_ta' => 'required|string|max:255',
        'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $header = new Header();
    $header->alt_en = $request->alt_en;
    $header->alt_ta = $request->alt_ta;
    $header->is_public = $request->has('is_public') ? 1 : 0;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('headers', 'public');
        $header->image = $path;
    }

    $header->save();

    // Redirect back to index with flash success message
    return redirect()
        ->route('admin.header.index')
        ->with('success', 'Header created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function edit(Header $header)
    {
        return view('admin.header.edit', compact('header'));
    }

    public function update(Request $request, Header $header)
    {
        $request->validate([
            'alt_en' => 'required|string|max:255',
            'alt_ta' => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $header->alt_en = $request->alt_en;
        $header->alt_ta = $request->alt_ta;
        $header->is_public = $request->has('is_public') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($header->image && Storage::disk('public')->exists($header->image)) {
                Storage::disk('public')->delete($header->image);
            }
            $path = $request->file('image')->store('headers', 'public');
            $header->image = $path;
        }

        $header->save();

        // ✅ Redirect back with success
        return redirect()
            ->route('admin.header.index')
            ->with('success', 'Header updated successfully!');
    }
}
