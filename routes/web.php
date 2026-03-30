<?php

use Illuminate\Support\Facades\Route;

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