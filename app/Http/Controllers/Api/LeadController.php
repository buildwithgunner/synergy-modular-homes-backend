<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::with('home')->latest()->get();
        return response()->json($leads);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_id' => 'nullable|exists:homes,id',
            'name' => 'required|string|max:255',
           'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        $lead = Lead::create([
            ...$validated,
            'status' => 'new',
        ]);

        return response()->json([
            'message' => 'Lead submitted successfully',
            'lead' => $lead
        ], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:new,contacted,closed',
        ]);

        $lead->update(['status' => $validated['status']]);
        return response()->json($lead);
    }
}