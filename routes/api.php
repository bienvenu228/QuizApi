<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


// Authentification
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/stats', [QuizController::class, 'stats']);
    Route::get('/phases', [QuizController::class, 'phases']);
    Route::get('/phases/{id}/themes', [QuizController::class, 'themes']);
    Route::get('/themes/{id}/questions', [QuizController::class, 'questions']);
    Route::post('/user/answers', [QuizController::class, 'storeAnswers']);

      // Routes CRUD pour PhaseController
    Route::apiResource('phases', PhaseController::class);
});

