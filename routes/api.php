<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Users
Route::get('/admin/users',         [AdminController::class, 'apiUsers']);
Route::post('/admin/users',        [AdminController::class, 'apiStoreUser']);
Route::put('/admin/users/{id}',    [AdminController::class, 'apiUpdateUser']);
Route::delete('/admin/users/{id}', [AdminController::class, 'apiDestroyUser']);

// Game Scores
Route::get('/admin/game-scores',         [AdminController::class, 'apiGameScores']);
Route::post('/admin/game-scores',        [AdminController::class, 'apiStoreGameScore']);
Route::put('/admin/game-scores/{id}',    [AdminController::class, 'apiUpdateGameScore']);
Route::delete('/admin/game-scores/{id}', [AdminController::class, 'apiDestroyGameScore']);

Route::prefix('admin')->group(function () {
    Route::get('/settings', [GameSettingController::class, 'index']);
    Route::put('/settings', [GameSettingController::class, 'update']);
    
    Route::apiResource('quizzes', QuizController::class);
});