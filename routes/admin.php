<?php

use App\Http\Controllers\Shared\Admin\AddUserController;
use App\Http\Controllers\Shared\Admin\EditUserController;
use App\Http\Controllers\Shared\Admin\SettingsController;
use App\Http\Controllers\Shared\Admin\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Shared Routes
|--------------------------------------------------------------------------
|
| Shared Admin routes used by regardless of site mode.
|
*/


Route::prefix('/admin')->group(function () {

    Route::get('/add-user', [AddUserController::class, 'Get'])->middleware('auth');
    Route::post('/add-user', [AddUserController::class, 'Post'])->middleware('auth');

    Route::get('/users', [UsersController::class, 'Get'])->middleware('auth');
    Route::get('/users/{id}', [EditUserController::class, 'Get'])->middleware('auth');
    Route::post('/users/{id}', [EditUserController::class, 'Post'])->middleware('auth');
    Route::get('/settings',[SettingsController::class,'Get'])->middleware('auth');
    Route::post('/settings',[SettingsController::class,'Post'])->middleware('auth');

});
