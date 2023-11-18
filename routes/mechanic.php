<?php

use App\Http\Controllers\Mechanic\AllRepairs;
use App\Http\Controllers\Mechanic\ApplicationsView;
use App\Http\Controllers\Mechanic\Dashboard;
use App\Http\Controllers\Mechanic\ImpoundHistory;
use App\Http\Controllers\Mechanic\PurchaseCalculator;
use App\Http\Controllers\Mechanic\RepairEditor;
use App\Http\Controllers\Mechanic\RepairLogger;
use App\Http\Controllers\Mechanic\TowTracker;
use App\Http\Controllers\Shared\ApplicationsList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/apply.php';
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware('auth');

    Route::prefix('/mechanic')->group(function () {
        Route::get('/repair-logger', [RepairLogger::class, 'index'])->name('mechanic-repair-log-index');
        Route::get('/repair-logger/{id}', [RepairEditor::class, 'index'])->name('mechanic-repair-log-edit');

        Route::get('/repairs', [AllRepairs::class, 'index'])->middleware('auth')->name('mechanic-all-repairs');
        //Route::get('/repairs/{id}/delete',[RepairDelete::class,'Get'])->middleware('auth');

        Route::get('/purchase', [PurchaseCalculator::class, 'index'])->middleware('auth')->name('mechanic-purchase-calculator');
    })->middleware('auth');

    Route::prefix('/tow')->group(function () {
        Route::get('/tracker', [TowTracker::class, 'index'])->name('tow-tracker');
        Route::get('/impound-history', [ImpoundHistory::class, 'index'])->name('tow-impound-history');
    })->middleware('auth');


    Route::prefix('/admin')->group(function () {
        Route::get('/applications', [ApplicationsList::class, 'index'])->name('admin-pending-applications');
        Route::get('/applications/{id}', [ApplicationsView::class, 'index'])->name('admin-view-application');
        Route::post('/applications/{id}', [ApplicationsView::class, 'post'])->name('admin-accept-application');
    });
});
