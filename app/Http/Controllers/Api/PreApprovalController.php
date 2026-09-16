<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreApproval;
use Illuminate\Http\Request;

class PreApprovalController extends Controller
{
    /**
     * Display a listing of all pre-approval applications.
     */
    public function index()
    {
        $preApprovals = PreApproval::latest()->get();
        return response()->json($preApprovals, 200);
    }

    /**
     * Store a newly created pre-approval application in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'dob' => 'required|string',
            'ssn' => 'required|string',
            'email' => 'required|email|max:255',
            'cell_phone' => 'required|string|max:255',
            'credit_score' => 'nullable|string',
            'purchasing_method' => 'required|string',
            'co_applicant' => 'nullable|string',
            'how_soon' => 'nullable|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:255',
            'years_at_address' => 'nullable|string',
            'housing_situation' => 'nullable|string',
            'rent_or_mortgage' => 'nullable|string',
            'proof_of_income' => 'nullable|array',
            'form_of_payment_1' => 'nullable|string',
            'form_of_payment_2' => 'nullable|string',
            'income_before_tax' => 'nullable|string',
            'pay_frequency' => 'nullable|string',
            'overtime_amount' => 'nullable|string',
            'preferred_bedrooms' => 'nullable|string',
            'preferred_home_size' => 'nullable|string',
            'down_payment' => 'nullable|string',
            'monthly_budget' => 'nullable|string',
            'signature' => 'required|string|max:255',
        ]);

        $preApproval = PreApproval::create($validated);

        return response()->json([
            'message' => 'Pre-approval application submitted successfully.',
            'data' => $preApproval
        ], 201);
    }

    /**
     * Display the specified pre-approval application.
     */
    public function show($id)
    {
        $preApproval = PreApproval::findOrFail($id);
        return response()->json($preApproval, 200);
    }

    /**
     * Update the status of a pre-approval application.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected'
        ]);

        $preApproval = PreApproval::findOrFail($id);
        $preApproval->status = $request->status;
        $preApproval->save();

        return response()->json([
            'message' => 'Status updated successfully.',
            'data' => $preApproval
        ], 200);
    }

    /**
     * Remove the specified pre-approval application.
     */
    public function destroy($id)
    {
        $preApproval = PreApproval::findOrFail($id);
        $preApproval->delete();

        return response()->json(['message' => 'Pre-approval application deleted successfully.'], 200);
    }
}