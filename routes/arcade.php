<?php

use App\Http\Controllers\Arcade\Admin\ArcadeSettings;
use App\Http\Controllers\Shared\Admin\ApplicationController;
use App\Http\Controllers\Shared\Admin\ApplicationsController;
use App\Http\Controllers\Shared\Admin\SpecialsController;
use App\Http\Controllers\Arcade\DashboardController;
use App\Http\Controllers\Arcade\Sales\SalesLogger;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Arcade Routes
|--------------------------------------------------------------------------
|
| All routes specific the Arcade Mode
|
*/



Route::get('/dashboard', [DashboardController::class, 'Get'])->middleware('auth');

Route::prefix('/arcade')->group(function () {
    Route::get('/sale-logger',[SalesLogger::class,'Get'])->middleware('auth');
    Route::post('/sale-logger',[SalesLogger::class,'Post'])->middleware('auth');
});

Route::prefix('/admin')->group(function () {

    Route::get('/specials',[SpecialsController::class,'Get'])->middleware('auth');
    Route::post('/specials',[SpecialsController::class,'Post'])->middleware('auth');
    Route::get('/specials/enable/{id}',[SpecialsController::class,'Enable'])->middleware('auth');
    Route::get('/specials/disable/{id}',[SpecialsController::class,'Disable'])->middleware('auth');

    Route::get('/arcade-settings',[ArcadeSettings::class,'Get'])->middleware('auth');
    Route::post('/arcade-settings',[ArcadeSettings::class,'Post'])->middleware('auth');

    Route::prefix('/applications')->group(function (){
        Route::get('/',[ApplicationsController::class,'Get'])->middleware('auth');
        Route::get('/{id}',[ApplicationController::class,'Get'])->middleware('auth');
        Route::post('/{id}',[ApplicationController::class,'Post'])->middleware('auth');
    });
});
