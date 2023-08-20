<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\Shared\Account\EditAccountController;
use App\Http\Controllers\Shared\Team\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shared Routes
|--------------------------------------------------------------------------
|
| Shared Non-Admin routes used by regardless of site mode.
|
*/

Route::redirect('/', '/dashboard')->middleware('auth');
Route::redirect('/index', '/dashboard')->middleware('auth');
Route::get('/clock-on/{action}', [ActionController::class, 'ClockInOut'])->middleware('auth');
Route::get('/team', [TeamController::class,'Get'])->middleware('auth');
Route::get('/account/settings',[EditAccountController::class, 'Get'])->middleware('auth');
Route::post('/account/settings',[EditAccountController::class, 'Post'])->middleware('auth');
