<?php

use App\Http\Controllers\RecommendationController;

Route::middleware('auth:sanctum')->group(function () {
    // রিকমেন্ডেশন এন্ডপয়েন্ট
    Route::get('/recommendations/personalized', [RecommendationController::class, 'getPersonalizedRecommendations']);
    Route::get('/recommendations/smart', [RecommendationController::class, 'getSmartRecommendations']);
    Route::put('/recommendations/preferences', [RecommendationController::class, 'updatePreferences']);
    Route::post('/recommendations/feedback', [RecommendationController::class, 'provideFeedback']);
});