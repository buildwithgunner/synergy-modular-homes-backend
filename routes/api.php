<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdminSettingsController;
use App\Http\Controllers\Api\SavedHomeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PreApprovalController;
// ===================== PUBLIC =====================
Route::get('/homes', [HomeController::class, 'index']);
Route::get('/homes/{id}', [HomeController::class, 'show']);

Route::post('/leads', [LeadController::class, 'store']);

// User auth
Route::post('/send-otp', [AuthController::class, 'sendOtp'])
    ->middleware('throttle:5,1');

Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])
    ->middleware('throttle:5,1');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

// Admin auth
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1');

// ===================== AUTHENTICATED (User + Admin token) =====================
Route::middleware('auth:sanctum')->group(function () {
    // Homes (admin manage)
    Route::post('/homes', [HomeController::class, 'store']);
    Route::put('/homes/{id}', [HomeController::class, 'update']);
    Route::delete('/homes/{id}', [HomeController::class, 'destroy']);

    // Leads (admin)
    Route::get('/leads', [LeadController::class, 'index']);
    Route::patch('/leads/{id}/status', [LeadController::class, 'updateStatus']);

    // Users (admin)
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Saved homes (user)
    Route::get('/saved-homes', [SavedHomeController::class, 'index']);
    Route::post('/saved-homes', [SavedHomeController::class, 'store']);
    Route::delete('/saved-homes/{homeId}', [SavedHomeController::class, 'destroy']);
    Route::get('/saved-homes/check/{homeId}', [SavedHomeController::class, 'check']);

    // Admin settings
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/settings', [AdminSettingsController::class, 'show']);
        Route::put('/settings', [AdminSettingsController::class, 'update']);
        Route::put('/change-password', [AdminSettingsController::class, 'changePassword']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    Route::post('/pre-approvals', [PreApprovalController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pre-approvals', [PreApprovalController::class, 'index']);
    Route::get('/pre-approvals/{id}', [PreApprovalController::class, 'show']);
    Route::patch('/pre-approvals/{id}/status', [PreApprovalController::class, 'updateStatus']);
    Route::delete('/pre-approvals/{id}', [PreApprovalController::class, 'destroy']);
});
});