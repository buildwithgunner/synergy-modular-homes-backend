<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments/leads.
     */
    public function index(): JsonResponse
    {
        $appointments = Lead::latest()->paginate(15);

        return response()->json([
            'status' => 'success',
            'data' => $appointments
        ]);
    }

    /**
     * Store a newly created appointment/lead.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'preferred_date' => 'nullable|string',
            'preferred_time' => 'nullable|string',
            'message' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $appointment = Lead::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully.',
            'data' => $appointment
        ], 201);
    }

    /**
     * Display the specified appointment details.
     */
    public function show($id): JsonResponse
    {
        $appointment = Lead::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $appointment
        ]);
    }

    /**
     * Update status of an appointment.
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $appointment = Lead::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment status updated.',
            'data' => $appointment
        ]);
    }

    /**
     * Remove the specified appointment.
     */
    public function destroy($id): JsonResponse
    {
        $appointment = Lead::findOrFail($id);
        $appointment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment deleted successfully.'
        ]);
    }
}