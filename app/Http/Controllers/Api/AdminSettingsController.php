<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminSettingsController extends Controller
{
    public function show(Request $request)
    {
        $admin = $request->user();

        if (!$admin) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'name' => $admin->name,
            'email' => $admin->email,
            'phone' => $admin->phone ?? '',
            'notifications' => $admin->notifications ?? [
                'newLeads' => true,
                'appointments' => true,
                'weeklyReport' => false,
            ],
        ]);
    }

    public function update(Request $request)
    {
        $admin = $request->user();

        if (!$admin) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
   'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:30',
            'notifications' => 'nullable|array',
        ]);

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'notifications' => $validated['notifications'] ?? $admin->notifications,
        ]);

        return response()->json(['message' => 'Settings updated successfully']);
    }

    public function changePassword(Request $request)
    {
        $admin = $request->user();

        if (!$admin) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['message' => 'Password changed successfully']);
    }
}