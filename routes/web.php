<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('gridstart');
});

Route::get('/start-grid', function () {
    return view('roadmap.lesson-start-grid');
});

Route::get('/yellow-flag', function () {
    return view('roadmap.lesson-yellow-flag');
});

Route::get('/racing-line', function () {
    return view('roadmap.lesson-racing-line');
});

Route::get('/brake', function () {
    return view('roadmap.lesson-brake-zone');
});

Route::get('/brake-zone', function () {
    return view('roadmap.lesson-brake-zone');
});

Route::get('/signon', function () {
    return view('signon');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/signon', [AuthController::class, 'showSignon'])->name('signon');
Route::post('/signon', [AuthController::class, 'signon'])->name('signon.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');