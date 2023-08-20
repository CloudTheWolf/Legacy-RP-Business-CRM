<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doj\DashboardController;

/*
|--------------------------------------------------------------------------
| DOJ Routes
|--------------------------------------------------------------------------
|
| All routes specific the DOJ Mode
|
*/

Route::get('/dashboard', [DashboardController::class, 'Get'])->middleware('auth');
