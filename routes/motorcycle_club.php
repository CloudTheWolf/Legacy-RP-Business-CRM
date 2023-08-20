<?php

use App\Http\Controllers\Shared\Warehouse\viewAllWarehousesController;
use App\Http\Controllers\Shared\Warehouse\viewWarehouseController;
use App\Http\Controllers\Mechanic\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Motorcycle Club Routes
|--------------------------------------------------------------------------
|
| All routes specific the Motorcycle Club Mode
|
*/


Route::get('/dashboard', [DashboardController::class, 'Get'])->middleware('auth');
Route::prefix("/storage")->group(function (){
    Route::get('/',[viewAllWarehousesController::class,'get'])->middleware('auth');
    Route::get('/{id}',[viewWarehouseController::class,'get'])->middleware('auth');
})->middleware('auth');
