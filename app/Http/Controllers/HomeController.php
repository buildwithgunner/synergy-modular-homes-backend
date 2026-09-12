<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json(Home::latest()->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'beds' => 'required|integer',
            'baths' => 'required|integer',
            'sqft' => 'nullable|string',
            'location' => 'required|string',
            'image_path' => 'nullable|string',
        ]);

        $home = Home::create($validated);
        return response()->json($home, 201);
    }

    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();
        return response()->json(['message' => 'Listing removed'], 200);
    }
}