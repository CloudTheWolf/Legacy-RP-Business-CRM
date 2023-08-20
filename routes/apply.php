<?php

use App\Http\Controllers\Authentication\SteamLogin;
use App\Http\Controllers\Shared\Applications\ApplicationSelectProfile;
use App\Http\Controllers\Shared\Applications\ApplicationWelcome;
use Illuminate\Support\Facades\Route;

Route::prefix('/apply')->group(function () {
    Route::get('/', [ApplicationWelcome::class, 'Get']);
    Route::get('/select-profile', [ApplicationSelectProfile::class, 'Get']);
    Route::post('/select-profile', [ApplicationSelectProfile::class, 'Post']);
    Route::prefix('/auth')->group(function () {
        Route::get('/steam', [SteamLogin::class, 'get'])->name('apply.auth.steam');
        Route::get('/steam/handle', [SteamLogin::class, 'handle'])->name('apply.auth.steam.handle');
    });
});
