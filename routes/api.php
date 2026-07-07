<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OpportunityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Auth Required)
|--------------------------------------------------------------------------
*/
Route::get('/filters', [OpportunityController::class, 'filters']);
Route::get('/deadlines', [OpportunityController::class, 'deadlines']);
Route::get('/universities', [DashboardController::class, 'universities']);

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth.session')->group(function () {

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::put('/auth/profile', [AuthController::class, 'updateProfile']);

    Route::get('/opportunities', [OpportunityController::class, 'index']);
    Route::get('/opportunities/{id}', [OpportunityController::class, 'show']);

    Route::get('/bookmarks', [BookmarkController::class, 'index']);
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle']);

    Route::get('/applications', [ApplicationController::class, 'index']);
    Route::post('/applications/apply', [ApplicationController::class, 'apply']);
    Route::put('/applications/move', [ApplicationController::class, 'moveStatus']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/read', [NotificationController::class, 'markRead']);

    Route::get('/stats', [DashboardController::class, 'stats']);
    Route::get('/recommendations', [DashboardController::class, 'recommendations']);
    Route::get('/trending', [DashboardController::class, 'trending']);
    Route::post('/eligibility/check', [DashboardController::class, 'checkEligibility']);

    // Faculty only
    Route::middleware('faculty')->group(function () {
        Route::post('/opportunities', [OpportunityController::class, 'store']);
    });
});