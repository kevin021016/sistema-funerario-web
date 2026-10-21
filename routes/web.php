<?php

use Illuminate\Support\Facades\Route;

// 1. Mantén el Login si quieres que sea una página independiente (no SPA)
// resources/routes/web.php

// 1. Ruta abierta para el Login (Blade)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 2. Ruta protegida por Laravel
// Solo si el servidor detecta una sesión activa entregará la SPA
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');