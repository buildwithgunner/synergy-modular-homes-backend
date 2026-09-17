<?php

namespace App\Http\Controllers;

use App\Models\PreApproval;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class PreApprovalController extends Controller
{
    /**
     * Handle the incoming pre-approval submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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

        // Process proof_of_income if uploaded as files or passed as paths
        if ($request->hasFile('proof_of_income')) {
            $uploadedPaths = [];
            foreach ($request->file('proof_of_income') as $file) {
                if ($file->isValid()) {
                    // Stores files in storage/app/public/proofs
                    $path = $file->store('proofs', 'public');
                    $uploadedPaths[] = Storage::url($path);
                }
            }
            $validated['proof_of_income'] = $uploadedPaths;
        }

        // Save to database
        $preApproval = PreApproval::create($validated);

        return response()->json([
            'message' => 'Pre-approval application submitted successfully.',
            'data'    => $preApproval,
        ], 201);
    }
}