<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mechanic\Repair\RepairDelete;
use App\Http\Controllers\Mechanic\Repair\RepairEdit;
use App\Http\Controllers\Mechanic\Admin\MechanicSettings;
use App\Http\Controllers\Mechanic\Applications\Application;
use App\Http\Controllers\Mechanic\DashboardController;
use App\Http\Controllers\Mechanic\Repair\Purchase;
use App\Http\Controllers\Mechanic\Repair\RepairLogger;
use App\Http\Controllers\Mechanic\Repair\Repairs;
use App\Http\Controllers\Mechanic\Tow\TowHistory;
use App\Http\Controllers\Mechanic\Tow\TowTracker;
use App\Http\Controllers\Mechanic\Tow\TowTally;
use App\Http\Controllers\Shared\Admin\ApplicationsController;
use App\Http\Controllers\Shared\Admin\ApplicationController;

/*
|--------------------------------------------------------------------------
| Mechanic Routes
|--------------------------------------------------------------------------
|
| All routes specific the Mechanic Mode
|
*/

Route::get('/dashboard', [DashboardController::class, 'Get'])->middleware('auth');

Route::prefix('/tow')->group(function () {

    Route::post('/', [TowTally::class, 'Post'])->name('tow.tally')->middleware('auth');
    Route::get('/tracker',[TowTracker::class,'Get'])->middleware('auth');
    Route::post('/tracker',[TowTracker::class,'Post'])->middleware('auth');

    Route::get('/history',[TowHistory::class,'Get'])->middleware('auth');
});

Route::prefix('/mechanic')->group(function (){
    Route::get('/repair-logger',[RepairLogger::class,'Get'])->middleware('auth');
    Route::post('/repair-logger',[RepairLogger::class,'Post'])->middleware('auth');

    Route::get('/repairs',[Repairs::class,'Get'])->middleware('auth');
    Route::get('/repairs/{id}',[RepairEdit::class,'Get'])->middleware('auth');
    Route::post('/repairs/{id}',[RepairEdit::class,'Post'])->middleware('auth');
    Route::get('/repairs/{id}/delete',[RepairDelete::class,'Get'])->middleware('auth');

    Route::get('/purchase',[Purchase::class,'Get'])->middleware('auth');
    Route::post('/purchase',[Purchase::class,'Post'])->middleware('auth');
});

Route::post('/apply/done', [Application::class, 'Post']);

Route::prefix('/admin')->group(function (){

    Route::prefix('/applications')->group(function (){
        Route::get('/',[ApplicationsController::class,'Get'])->middleware('auth');
        Route::get('/{id}',[ApplicationController::class,'Get'])->middleware('auth');
        Route::post('/{id}',[ApplicationController::class,'Post'])->middleware('auth');
    });
    Route::get('/past-applications',[ApplicationsController::class,'GetDone'])->middleware('auth');
    Route::get('/mechanic-settings',[MechanicSettings::class,'Get'])->middleware('auth');
    Route::post('/mechanic-settings',[MechanicSettings::class,'Post'])->middleware('auth');

});

require __DIR__ . '/apply.php';
