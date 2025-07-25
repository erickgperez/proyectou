<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('dashboard', function (Request $request) {
    return Inertia::render('Home', [
        'componente' => 'dashboard',
        'titulo' => 'Dashboard',
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/informe/example', function () {
    return Inertia::render('Home', [
        'componente' => 'informeExample',
        'titulo' => 'Informe de ejemplo',
    ]);
})->middleware(['auth', 'verified'])->name('informe-example');

Route::get('/crud/example', function () {
    return Inertia::render('Home', [
        'componente' => 'crudExample',
        'titulo' => 'Ejemplo de CRUD',
    ]);
})->middleware(['auth', 'verified'])->name('crud-example');
Route::get('/c', function () {
    return Inertia::render('Home', [
        'componente' => '',
        'titulo' => '',
    ]);
})->middleware(['auth', 'verified'])->name('close');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
