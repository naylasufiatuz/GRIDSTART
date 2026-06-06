<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
Route::middleware(['web', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    // Users
    Route::get('/users',         [AdminController::class, 'apiUsers']);
    Route::post('/users',        [AdminController::class, 'apiStoreUser']);
    Route::put('/users/{id}',    [AdminController::class, 'apiUpdateUser']);
    Route::delete('/users/{id}', [AdminController::class, 'apiDestroyUser']);

    // Game Scores
    Route::get('/game-scores',         [AdminController::class, 'apiGameScores']);
    Route::post('/game-scores',        [AdminController::class, 'apiStoreGameScore']);
    Route::put('/game-scores/{id}',    [AdminController::class, 'apiUpdateGameScore']);
    Route::delete('/game-scores/{id}', [AdminController::class, 'apiDestroyGameScore']);

    // Pesan (Messages)
    Route::get('/pesan',         [AdminController::class, 'apiPesans']);
    Route::post('/pesan',        [AdminController::class, 'apiStorePesan']);
    Route::put('/pesan/{id}',    [AdminController::class, 'apiUpdatePesan']);
    Route::delete('/pesan/{id}', [AdminController::class, 'apiDestroyPesan']);

    // Settings & Quizzes
    Route::get('/settings', [GameSettingController::class, 'index']);
    Route::put('/settings', [GameSettingController::class, 'update']);

    Route::apiResource('quizzes', QuizController::class);
});