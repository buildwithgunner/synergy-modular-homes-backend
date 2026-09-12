<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SavedHome;
use Illuminate\Http\Request;

class SavedHomeController extends Controller
{
    // GET /api/saved-homes
    public function index(Request $request)
    {
        $saved = SavedHome::with('home')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get()
            ->pluck('home')
            ->filter()
            ->values();

        return response()->json($saved);
    }

    // POST /api/saved-homes
    // body: { home_id: 1 }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_id' => 'required|exists:homes,id',
        ]);

        $saved = SavedHome::firstOrCreate([
            'user_id' => $request->user()->id,
            'home_id' => $validated['home_id'],
        ]);

        return response()->json([
            'message' => 'Home saved',
            'saved' => true,
            'id' => $saved->id,
        ], 201);
    }

    // DELETE /api/saved-homes/{homeId}
    public function destroy(Request $request, $homeId)
    {
        SavedHome::where('user_id', $request->user()->id)
            ->where('home_id', $homeId)
            ->delete();

        return response()->json([
            'message' => 'Home removed from saved',
            'saved' => false,
        ]);
    }

    // GET /api/saved-homes/check/{homeId}
    public function check(Request $request, $homeId)
    {
        $exists = SavedHome::where('user_id', $request->user()->id)
            ->where('home_id', $homeId)
            ->exists();

        return response()->json(['saved' => $exists]);
    }
}