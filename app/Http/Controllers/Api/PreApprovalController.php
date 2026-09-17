<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PreApproval;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PreApprovalController extends Controller
{
    /**
     * Public submission route for pre-approvals.
     * Route: POST /api/pre-approvals
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'middle_name'         => 'nullable|string|max:255',
            'dob'                 => 'required|string',
            'ssn'                 => 'required|string',
            'email'               => 'required|email|max:255',
            'cell_phone'          => 'required|string|max:255',
            'credit_score'        => 'nullable|string',
            'purchasing_method'   => 'required|string',
            'co_applicant'        => 'nullable|string',
            'how_soon'            => 'nullable|string',
            'address'             => 'required|string|max:255',
            'city'                => 'required|string|max:255',
            'state'               => 'required|string|max:255',
            'zip'                 => 'required|string|max:255',
            'years_at_address'    => 'nullable|string',
            'housing_situation'  => 'nullable|string',
            'rent_or_mortgage'   => 'nullable|string',
            'proof_of_income'     => 'nullable|array',
            'proof_of_income.*'   => 'nullable',
            'form_of_payment_1'  => 'nullable|string',
            'form_of_payment_2'  => 'nullable|string',
            'income_before_tax'   => 'nullable|string',
            'pay_frequency'       => 'nullable|string',
            'overtime_amount'     => 'nullable|string',
            'preferred_bedrooms'  => 'nullable|string',
            'preferred_home_size' => 'nullable|string',
            'down_payment'        => 'nullable|string',
            'monthly_budget'      => 'nullable|string',
            'signature'           => 'required|string|max:255',
        ]);

        if ($request->hasFile('proof_of_income')) {
            $uploadedPaths = [];
            foreach ($request->file('proof_of_income') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('proofs', 'public');
                    $uploadedPaths[] = Storage::url($path);
                }
            }
            $validated['proof_of_income'] = $uploadedPaths;
        }

        $preApproval = PreApproval::create($validated);

        return response()->json([
            'message' => 'Pre-approval application submitted successfully.',
            'data'    => $preApproval,
        ], 201);
    }

    /**
     * Admin: Fetch all pre-approval applications.
     * Route: GET /api/pre-approvals
     */
    public function index(): JsonResponse
    {
        $preApprovals = PreApproval::latest()->get();

        return response()->json($preApprovals);
    }

    /**
     * Admin: Get a single pre-approval application by ID.
     * Route: GET /api/pre-approvals/{id}
     */
    public function show($id): JsonResponse
    {
        $preApproval = PreApproval::findOrFail($id);

        return response()->json($preApproval);
    }

    /**
     * Admin: Update application status (e.g., approved, pending, rejected).
     * Route: PATCH /api/pre-approvals/{id}/status
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $preApproval = PreApproval::findOrFail($id);
        $preApproval->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Pre-approval status updated successfully.',
            'data'    => $preApproval,
        ]);
    }

    /**
     * Admin: Delete a pre-approval application.
     * Route: DELETE /api/pre-approvals/{id}
     */
    public function destroy($id): JsonResponse
    {
        $preApproval = PreApproval::findOrFail($id);
        $preApproval->delete();

        return response()->json([
            'message' => 'Pre-approval application deleted successfully.',
        ]);
    }
}