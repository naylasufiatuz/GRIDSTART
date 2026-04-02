<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::get('/signon', [AuthController::class, 'showSignon'])->name('signon');
Route::post('/signon', [AuthController::class, 'signon'])->name('signon.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/app', [HomeController::class, 'index'])->name('app')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/roadmap', function () {
    return view('gridstart');
});

Route::get('/edukasi', function () {
    return view('edukasi');
});

Route::get('/simulasi', function () {
    return view('simulasi');
});

Route::get('/support', function () {
    return view('support');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');