<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\GameScoreController;
use App\Http\Controllers\Api\Admin\PesanController;
use App\Http\Controllers\Api\Admin\GameSettingController;
use App\Http\Controllers\Api\Admin\QuizController;

// ═══════════════════════════════════════════════════
// PUBLIC API ROUTES — Accessible by authenticated users
// ═══════════════════════════════════════════════════
Route::middleware(['web', 'auth'])->group(function () {
    // Public read-only quiz data for the game simulation
    Route::get('/quizzes', [QuizController::class, 'index']);
});

// ═══════════════════════════════════════════════════
// ADMIN API ROUTES — Protected dengan middleware 'admin'
// ═══════════════════════════════════════════════════
Route::middleware(['web', 'admin'])->prefix('admin')->group(function() 
{
    // Dashboard Stats & Activity
    Route::get('/dashboard/stats',    [DashboardController::class, 'stats']);
    Route::get('/dashboard/activity', [DashboardController::class, 'activity']);

    // Users
    Route::get('/users',         [UserController::class, 'index']);
    Route::post('/users',        [UserController::class, 'store']);
    Route::put('/users/{id}',    [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Game Scores
    Route::get('/game-scores',         [GameScoreController::class, 'index']);
    Route::post('/game-scores',        [GameScoreController::class, 'store']);
    Route::put('/game-scores/{id}',    [GameScoreController::class, 'update']);
    Route::delete('/game-scores/{id}', [GameScoreController::class, 'destroy']);

    // Pesan (Messages)
    Route::get('/pesan',         [PesanController::class, 'index']);
    Route::post('/pesan',        [PesanController::class, 'store']);
    Route::put('/pesan/{id}',    [PesanController::class, 'update']);
    Route::delete('/pesan/{id}', [PesanController::class, 'destroy']);

    // Settings & Quizzes
    Route::get('/settings', [GameSettingController::class, 'index']);
    Route::put('/settings', [GameSettingController::class, 'update']);

    Route::apiResource('quizzes', QuizController::class);
});