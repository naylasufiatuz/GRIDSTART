<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\Admin\GameSettingController;
use App\Http\Controllers\Api\Admin\QuizController;

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

// Pesan (Messages)
Route::get('/admin/pesan',         [AdminController::class, 'apiPesans']);
Route::post('/admin/pesan',        [AdminController::class, 'apiStorePesan']);
Route::put('/admin/pesan/{id}',    [AdminController::class, 'apiUpdatePesan']);
Route::delete('/admin/pesan/{id}', [AdminController::class, 'apiDestroyPesan']);

Route::prefix('admin')->group(function () {
    Route::get('/settings', [GameSettingController::class, 'index']);
    Route::put('/settings', [GameSettingController::class, 'update']);
    
    Route::apiResource('quizzes', QuizController::class);
});