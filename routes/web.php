<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/coin/list/{sort?}/{currencyType?}', [CryptoController::class, 'index']);

Route::get('/coin/{symbol}/{currency?}', [CryptoController::class, 'show']);


require __DIR__.'/auth.php';
