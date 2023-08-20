<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shared\Applications\BarApplication;
use App\Http\Controllers\Bars\DashboardController;
use App\Http\Controllers\Bars\Sales\SalesLogger;
use App\Http\Controllers\Bars\Admin\BarSettings;
use App\Http\Controllers\Shared\Admin\ApplicationsController;
use App\Http\Controllers\Shared\Admin\ApplicationController;
use App\Http\Controllers\Shared\Admin\SpecialsController;

/*
|--------------------------------------------------------------------------
| Bar Routes
|--------------------------------------------------------------------------
|
| All routes specific the Bar Mode
|
*/


Route::get('/dashboard', [DashboardController::class, 'Get'])->middleware('auth');

Route::prefix('/bar')->group(function () {
    Route::get('/sale-logger',[DashboardController::class,'Get'])->middleware('auth');
    Route::post('/sale-logger',[SalesLogger::class,'Post'])->middleware('auth');

});

Route::post('/apply/done', [BarApplication::class, 'Post']);

Route::prefix('/admin')->group(function (){

    Route::get('/specials',[SpecialsController::class,'Get'])->middleware('auth');
    Route::post('/specials',[SpecialsController::class,'Post'])->middleware('auth');
    Route::get('/specials/enable/{id}',[SpecialsController::class,'Enable'])->middleware('auth');
    Route::get('/specials/disable/{id}',[SpecialsController::class,'Disable'])->middleware('auth');

    Route::get('/bar-settings',[BarSettings::class,'Get'])->middleware('auth');
    Route::post('/bar-settings',[BarSettings::class,'Post'])->middleware('auth');

    Route::prefix('/applications')->group(function (){
        Route::get('/',[ApplicationsController::class,'Get'])->middleware('auth');
        Route::get('/{id}',[ApplicationController::class,'Get'])->middleware('auth');
        Route::post('/{id}',[ApplicationController::class,'Post'])->middleware('auth');
    });

});
