<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mechanic\Dashboard;
use App\Http\Controllers\Mechanic\RepairLogger;


Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard')->middleware('auth');

Route::prefix('/mechanic')->group(function (){
    Route::get('/repair-logger',[RepairLogger::class,'index'])->name('repair-log-index');
    //Route::post('/repair-logger',[RepairLogger::class,'Post'])->middleware('auth');

    //Route::get('/repairs',[Repairs::class,'Get'])->middleware('auth');
    //Route::get('/repairs/{id}',[RepairEdit::class,'Get'])->middleware('auth');
    //Route::post('/repairs/{id}',[RepairEdit::class,'Post'])->middleware('auth');
    //Route::get('/repairs/{id}/delete',[RepairDelete::class,'Get'])->middleware('auth');

    //Route::get('/purchase',[Purchase::class,'Get'])->middleware('auth');
    //Route::post('/purchase',[Purchase::class,'Post'])->middleware('auth');
})->middleware('auth');
