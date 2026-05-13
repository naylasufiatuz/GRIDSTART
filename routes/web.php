<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AdminController;

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

Route::get('/', function () {
    return view('gridstart');
});

Route::get('/start-grid', function () {
    return view('lesson-start-grid');
});

Route::get('/yellow-flag', function () {
    return view('lesson-yellow-flag');
});

Route::get('/racing-line', function () {
    return view('lesson-racing-line');
});

Route::get('/brake', function () {
    return view('lesson-brake-zone');
});

Route::get('/brake-zone', function () {
    return view('lesson-brake-zone');
});

Route::get('/pit-stop', function () {
    return view('lesson-pit-stop');
});

Route::get('/finish-line', function () {
    return view('lesson-finish-line');
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

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');