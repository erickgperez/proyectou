<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('dashboard', function (Request $request) {
    return Inertia::render('Home', [
        'page' => 'dashboard'
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/informe/example', function () {
    return Inertia::render('Home', [
        'page' => 'informeExample'
    ]);
})->middleware(['auth', 'verified'])->name('informe-example');

Route::get('/crud/example', function () {
    return Inertia::render('Home', [
        'page' => 'crudExample'
    ]);
})->middleware(['auth', 'verified'])->name('crud-example');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
